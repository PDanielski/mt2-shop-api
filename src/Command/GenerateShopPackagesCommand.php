<?php


namespace App\Command;


use App\Document\CurrencyPackage;
use App\Document\MoneyGrabber;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateShopPackagesCommand extends Command {
    protected $registry;
    public function __construct(ManagerRegistry $registry) {
        $this->registry = $registry;
        parent::__construct();
    }

    public function configure() {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('shop:generate-packages')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln("Generazione pacchetti");
        $this->registry->getManager()->getDocumentCollection(CurrencyPackage::class)->drop();

        $manager = $this->registry->getManager();
        $package1 = new CurrencyPackage();
        $package1->setCoinsPerCurrency(array('gold'=>500));
        $package1->setName("Pacchetto mini");
        $package1->setPrice(500);
        $package1->setTeaser('Ottieni 500 monete');
        $manager->persist($package1);

        $package1 = new CurrencyPackage();
        $package1->setCoinsPerCurrency(array('gold'=>1100));
        $package1->setPrice(1000);
        $package1->setName("Pacchetto piccolo");
        $package1->setTeaser('Ottieni 1000 + 100 monete bonus');
        $manager->persist($package1);

        $package1 = new CurrencyPackage();
        $package1->setCoinsPerCurrency(array('gold'=>2800));
        $package1->setPrice(2500);
        $package1->setName("Pacchetto medio");
        $package1->setTeaser('Ottieni 2500 + 300 monete bonus');
        $manager->persist($package1);
		
        $package1 = new CurrencyPackage();
        $package1->setCoinsPerCurrency(array('gold'=>6000));
        $package1->setPrice(5000);
        $package1->setName("Pacchetto grande");
        $package1->setTeaser('Ottieni 5000 + 1000 monete bonus');
        $manager->persist($package1);

        $manager->flush();
        $output->writeln("Pacchetti generati");
    }
}