<?php


namespace App\Command;


use App\Document\BaseItem;
use App\Document\Icon;
use App\Document\Metin2Item;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateIconsCommand extends Command {
    protected $registry;
    public function __construct(ManagerRegistry $registry) {
        $this->registry = $registry;
        parent::__construct();
    }

    public function configure() {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('shop:generate-icons')

            // the short description shown while running "php bin/console list"
            ->setDescription('Inserisci le icone nel database data una directory.')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output) {
        $directory = "/var/www/https-metin2warlords.net/public/shop/assets/icons";
        $iterator = new \DirectoryIterator($directory);
        $manager = $this->registry->getManager();

        $output->writeln("Pulizia icone...");
        $manager->getDocumentCollection(Icon::class)->drop();

        $output->writeln("Pulizia icone degli item...");
        $items = $this->registry->getRepository(BaseItem::class)->findAll();
        foreach($items as $item){
            $item->setIcon(null);
        }
        $manager->flush();

        $output->writeln("Registrazione delle icone");
        $icons = array();
        foreach($iterator as $file){
            if(!$file->isDot()){
                $iconName = $file->getFilename();
                $iconNameWithoutExt = explode('.', $iconName)[0];
                $icon = new Icon();
                $icon->setHref('assets/icons/'.$iconName);
                $icon->setName($iconNameWithoutExt);
                $manager->persist($icon);
                $icons[$iconNameWithoutExt] = $icon;
            }
        }

        $output->writeln("Associazione item -> icona");
        foreach($items as $item){
            if($item::getType() == 'metin2Item' && $item instanceof Metin2Item){
                if($item->getItemData() && $item->getItemData()->getVnum()){
                    $vnum =  $item->getItemData()->getVnum();
                    if(isset($icons[$vnum])){
                        $item->setIcon($icons[$vnum]);
                    }
                }
            }
        }
        $manager->flush();

        $output->writeln("fine");
    }

}