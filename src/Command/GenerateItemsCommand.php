<?php


namespace App\Command;


use App\Document\BaseItem;
use App\Document\Category;
use App\Document\Icon;
use App\Document\Metin2Item;
use App\Document\Metin2ItemData;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateItemsCommand extends Command {
    protected $registry;
    public function __construct(ManagerRegistry $registry){
        parent::__construct();
        $this->registry = $registry;
    }
    public function configure() {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('shop:generate-items')
        ;
    }
    
    public function execute(InputInterface $input, OutputInterface $output) {
        $manager = $this->registry->getManager();
        $manager->getDocumentCollection(BaseItem::class)->drop();
        $manager->getDocumentCollection(Category::class)->drop();
        $manager->getDocumentCollection(Icon::class)->drop();
        
        // ITEMSHOP
	        // item generici
        $categoryEvent = new Category();
        $categoryEvent->setName("Item Evento");
        $categoryEvent->setLink("event-items");

        // item generici
        $categoryGeneric = new Category();
        $categoryGeneric->setName("Item Generici");
        $categoryGeneric->setLink("generic-items");
        // item speciali
        $categorySpecialItem = new Category();
        $categorySpecialItem->setName("Item Speciali");
        $categorySpecialItem->setLink("special-items");
        // armi
        $categorySkillUp = new Category();
        $categorySkillUp->setName("Miglioramento abilita'");
        $categorySkillUp->setLink("improve-abilities");
        // forzieri normali
        $categoryNormalBox = new Category();
        $categoryNormalBox->setName("Forzieri normali");
        $categoryNormalBox->setLink("normal-boxes");
        // forzieri speciali
        $categorySpecialBox = new Category();
        $categorySpecialBox->setName("Forzieri speciali");
        $categorySpecialBox->setLink("special-boxes");
        // mount
        $categoryMount = new Category();
        $categoryMount->setName("Mount");
        $categoryMount->setLink("mount");
        // mount
        $categoryGuildItem = new Category();
        $categoryGuildItem->setName("Item gilda");
        $categoryGuildItem->setLink("gitem");
        // ore
        $categoryOre = new Category();
        $categoryOre->setName("Minerali");
        $categoryOre->setLink("ore");
        // costumi
        $categoryCostumi = new Category();
        $categoryCostumi->setName("Costumi");
        $categoryCostumi->setLink("costums");
        // cinture
        $categoryBelt = new Category();
        $categoryBelt->setName("Cinture");
        $categoryBelt->setLink("belt");
		
        $manager->persist($categoryEvent);
        $manager->persist($categoryGeneric);
        $manager->persist($categorySpecialItem);
        $manager->persist($categoryNormalBox);
        $manager->persist($categorySpecialBox);
        $manager->persist($categorySkillUp);
        $manager->persist($categoryMount);
        $manager->persist($categoryCostumi);
        $manager->persist($categoryGuildItem);
        $manager->persist($categoryOre);
        $manager->persist($categoryBelt);
        /*
        $items = array();
        $items[] = $item;

        foreach($items as $i){
            $manager->persist($i);
        }
        */

        $items = array();

		$item = new Metin2Item();
        $item->setName("Cintura regale+0");
        $item->setTeaser("Si uppa con le pietre che rompe Mr.Pietro!");
        $item->setDesc("Livello minimo: 103. Bonus: Possibilità di difesa dai guerrieri/Max HP.");
        $item->setCategory($categoryBelt);
        $item->setPrices(array("gold"=>1000,"warpoints"=>2000, "biscuits"=>2000));
		$item->setIsStackable(false);
        $metadata = new Metin2ItemData();
        $metadata->setVnum(18040);
        $item->setItemData($metadata);
		
        $items[] = $item;
		$item = new Metin2Item();
        $item->setName("Cintura dell'ombra+0");
        $item->setTeaser("Si uppa con le pietre che rompe Mr.Pietro!");
        $item->setDesc("Livello minimo: 103. Bonus: Possibilità di difesa dai ninja/Max HP.");
        $item->setCategory($categoryBelt);
        $item->setPrices(array("gold"=>1000,"warpoints"=>2000, "biscuits"=>2000));
		$item->setIsStackable(false);
        $metadata = new Metin2ItemData();
        $metadata->setVnum(18050);
        $item->setItemData($metadata);
        $items[] = $item;

        $items[] = $item;
		$item = new Metin2Item();
        $item->setName("Cintura con rune+0");
        $item->setTeaser("Si uppa con le pietre che rompe Mr.Pietro!");
        $item->setDesc("Livello minimo: 103. Bonus: Possibilità di difesa dai sura/Max HP.");
        $item->setCategory($categoryBelt);
        $item->setPrices(array("gold"=>1000,"warpoints"=>2000, "biscuits"=>2000));
		$item->setIsStackable(false);
        $metadata = new Metin2ItemData();
        $metadata->setVnum(18060);
        $item->setItemData($metadata);
        $items[] = $item;

        $items[] = $item;
		$item = new Metin2Item();
        $item->setName("Cintura orso grande+0");
        $item->setTeaser("Il nome non lo abbiamo scelto noi");
        $item->setDesc("Livello minimo: 103. Bonus: Possibilità di difesa dai shamani/Max HP.");
        $item->setCategory($categoryBelt);
        $item->setPrices(array("gold"=>1000,"warpoints"=>2000, "biscuits"=>2000));
		$item->setIsStackable(false);
        $metadata = new Metin2ItemData();
        $metadata->setVnum(18070);
        $item->setItemData($metadata);
        $items[] = $item;

        $items[] = $item;
		$item = new Metin2Item();
        $item->setName("Cintura in tessuto+0");
        $item->setTeaser("Si uppa con le pietre che rompe Mr.Pietro!");
        $item->setDesc("Livello minimo: 50. Bonus: Max HP.");
		$item->setIsStackable(false);
        $item->setCategory($categoryBelt);
        $item->setPrices(array("gold"=>1000,"warpoints"=>2000, "biscuits"=>2000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(18000);
        $item->setItemData($metadata);
        $items[] = $item;
		
        $items[] = $item;
		$item = new Metin2Item();
        $item->setName("Cintura con rune+0");
        $item->setTeaser("Si uppa con le pietre che rompe Mr.Pietro!");
        $item->setDesc("Livello minimo: 100. Bonus: Forte contro mostri/Max HP.");
		$item->setIsStackable(false);
        $item->setCategory($categoryBelt);
        $item->setPrices(array("gold"=>1000,"warpoints"=>2000, "biscuits"=>2000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(18080);
        $item->setItemData($metadata);
        $items[] = $item;

				
        // $item = new Metin2Item();
        // $item->setName("Baule Weekend");
        // $item->setDesc("Può contenere: Perla rossa x2, Papiro consacrato x30, Incantesimo verde x2, Perla blu x4, Scatola Epica x5, Scatola Rara+ x3, Scatola Leggendaria x1, Trattato sulla scherma x1, Scatola Epica+ x2, Baule Raro x2. [Oggetti Rari]: Scatola Leggendaria x1, Baule Epico x1, Cavalcatura evento: Moa.");
        // $item->setCategory($categoryEvent);
        // $item->setPrices(array("gold"=>75,"warpoints"=>150, "biscuits"=>150));
        // $metadata = new Metin2ItemData();
        // $metadata->setVnum(25102);
		// $item->setIsStackable(false);
        // $item->setItemData($metadata);
        // $items[] = $item;
		
        $item = new Metin2Item();
        $item->setName("Cesto con Uova");
        $item->setDesc("Può contenere: Cesto vuoto x3, Metallo Magico x1, Papiro consacrato x50, Incantesimo verde x10, Baule Raro x3, Baule Epico x1, Sigillo di Sheldon, Sigillo di Cooper e tantissimi costumi!");
        $item->setCategory($categoryEvent);
        $item->setPrices(array("gold"=>100,"warpoints"=>200,"biscuits"=>200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50181);
		$item->setIsStackable(false);
        $item->setItemData($metadata);
        $items[] = $item;

        $item = new Metin2Item();
        $item->setName("Cesto vuoto");
        $item->setDesc("Un cesto vuoto in cui potrai mettere le uova pasquali");
        $item->setCategory($categoryEvent);
        $item->setPrices(array("gold"=>50,"warpoints"=>100, "biscuits"=>100));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50180);
		$item->setIsStackable(false);
        $item->setItemData($metadata);
        $items[] = $item;


        $item = new Metin2Item();
        $item->setName("Uovo pasquale");
        $item->setDesc("Un uovo di Pasqua dipinto con colori vivaci");
        $item->setCategory($categoryEvent);
        $item->setPrices(array("gold"=>50,"warpoints"=>100,"biscuits"=>100));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50180);
        $item->setIsStackable(false);
        $item->setItemData($metadata);
        $items[] = $item;

        $item = new Metin2Item();
        $item->setName("Uovo Magico");
        $item->setDesc("Può contenere: Costume Pasquale Speciale(solo del proprio sesso), Sigillo Donnie, Sigillo Frank.");
        $item->setCategory($categoryEvent);
        $item->setPrices(array("gold"=>150,"warpoints"=>300, "biscuits"=>300));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(71150);
		$item->setIsStackable(false);
        $item->setItemData($metadata);
        $items[] = $item;

        $item = new Metin2Item();
        $item->setName("Metallo Magico");
        $item->setDesc("Elimina il rischio di distruggere un oggetto se il miglioramento fallisce.");
        $item->setCategory($categoryGeneric);
        $item->setPrices(array("gold"=>250,"warpoints"=>500, "biscuits"=>500));
        $item->setTeaser("Utile per non far retrocere un oggetto.");
		$item->setIsStackable(false);
        $metadata = new Metin2ItemData();
        $metadata->setVnum(25041);
        $item->setItemData($metadata);
        $items[] = $item;
		
        $item = new Metin2Item();
        $item->setName("Metallo Magico (x10)");
        $item->setDesc("Elimina il rischio di distruggere un oggetto se il miglioramento fallisce.");
        $item->setCategory($categoryGeneric);
        $item->setPrices(array("gold"=>2000,"warpoints"=>4000, "biscuits"=>4000));
        $item->setTeaser("Utile per non far retrocere un oggetto.");
		$item->setIsStackable(false);
        $metadata = new Metin2ItemData();
        $metadata->setVnum(25041);
        $metadata->setCount(10);
        $item->setItemData($metadata);
        $items[] = $item;

        // ostrica
        $item = new Metin2Item();
        $item->setName("Ostrica");
        $item->setTeaser("La fortuna e' una meccanica fondamentale.");
        $item->setDesc("Puo' contenere: Perla bianca, Perla rossa, Perla blu.");
        $item->setCategory($categoryGeneric);
        $item->setPrices(array("gold"=>5,"warpoints"=>10, "biscuits"=>10));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(27987);
        $item->setItemData($metadata);
        $items[] = $item;
        // perla bianca
        $item = new Metin2Item();
        $item->setName("Perla Bianca");
        $item->setDesc("Utilizzata per miglioramenti +7.");
        $item->setCategory($categoryGeneric);
        $item->setPrices(array("gold"=>60,"warpoints"=>120, "biscuits"=>120));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(27992);
        $item->setItemData($metadata);
        $items[] = $item;
        // perla blu
        $item = new Metin2Item();
        $item->setName("Perla Blu");
        $item->setDesc("Utilizzata per miglioramenti +8 .");
        $item->setCategory($categoryGeneric);
        $item->setPrices(array("gold"=>80,"warpoints"=>160, "biscuits"=>160));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(27993);
        $item->setItemData($metadata);
        $items[] = $item;
        // perla rossa
        $item = new Metin2Item();
        $item->setName("Perla Rossa");
        $item->setDesc("Utilizzata per miglioramenti +9.");
        $item->setCategory($categoryGeneric);
        $item->setPrices(array("gold"=>100,"warpoints"=>200, "biscuits"=>200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(27994);
        $item->setItemData($metadata);
        $items[] = $item;
        // Arte mineraria
        $item = new Metin2Item();
        $item->setName("Arte mineraria");
        $item->setTeaser("Picconare non è mai stato così divertente.");
        $item->setDesc("Usalo per alzare il livello della scienza mineraria. Le possibilita' diminuiscono con il migliorare dell'abilita'.");
        $item->setCategory($categoryGeneric);
        $item->setPrices(array("gold"=>10,"warpoints"=>20, "biscuits"=>20));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50600);
        $item->setItemData($metadata);
        $items[] = $item;
        // Sun-zi
        $item = new Metin2Item();
        $item->setName("Sun-zi");
        $item->setDesc("Uno dei tre libri di strategia della guerra. Le possibilita' diminuiscono con il migliorare dell'abilita'.");
        $item->setCategory($categoryGeneric);
         
        $item->setPrices(array("gold"=>10,"warpoints"=>20, "biscuits"=>20));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50301);
        $item->setItemData($metadata);
        $items[] = $item;
        // Wu-zi
        $item = new Metin2Item();
        $item->setName("Wu-zi");
        $item->setDesc("Uno dei tre libri di strategia della guerra. Le possibilita' diminuiscono con il migliorare dell'abilita'.");
        $item->setCategory($categoryGeneric);
         
        $item->setPrices(array("gold"=>10,"warpoints"=>20, "biscuits"=>20));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50302);
        $item->setItemData($metadata);
        $items[] = $item;
        // Weilao-zi
        $item = new Metin2Item();
        $item->setName("Weilao-zi");
        $item->setDesc("Uno dei tre libri di strategia della guerra. Le possibilita' diminuiscono con il migliorare dell'abilita'.");
        $item->setCategory($categoryGeneric);
         
        $item->setPrices(array("gold"=>10,"warpoints"=>20, "biscuits"=>20));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50303);
        $item->setItemData($metadata);
        $items[] = $item;

        // pietra delle anime
        $item = new Metin2Item();
        $item->setName("Pietra delle anime (x10)");
        $item->setTeaser("Item utilizzato per migliorare la tua abilita' da G a P.");
        $item->setDesc("Le possibilita' di riuscita diminuisco con l'aumentare del livello delle abilita'");
        $item->setCategory($categorySkillUp);
		$item->setIsStackable(false);
        $item->setPrices(array("gold"=>200,"warpoints"=>400, "biscuits"=>400));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50513);
        $metadata->setCount(10);
        $item->setItemData($metadata);
        $items[] = $item;

        // scatola rara
        $item = new Metin2Item();
        $item->setName("Scatola Rara");
        $item->setDesc("Contiene 5 oggetti per UP non Epico");
        $item->setCategory($categoryNormalBox);
         
        $item->setPrices(array("gold"=>25,"warpoints"=>50, "biscuits"=>50));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(81010);
        $item->setItemData($metadata);
        $items[] = $item;
        // scatola epica
        $item = new Metin2Item();
        $item->setName("Scatola Epica");
        $item->setDesc("Contiene 15 oggetti per UP non Epico");
        $item->setCategory($categoryNormalBox);
         
        $item->setPrices(array("gold"=>50,"warpoints"=>100, "biscuits"=>100));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(81011);
        $item->setItemData($metadata);
        $items[] = $item;
        // scatola leggendaria
        $item = new Metin2Item();
        $item->setName("Scatola Leggendaria");
        $item->setDesc("Contiene 50 oggetti per UP non Epico");
        $item->setCategory($categoryNormalBox);
         
        $item->setPrices(array("gold"=>150,"warpoints"=>300, "biscuits"=>300));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(81012);
        $item->setItemData($metadata);
        $items[] = $item;
        // baule raro
        $item = new Metin2Item();
        $item->setName("Baule Raro");
        $item->setDesc("Puo' contenere: Pietra Rara, Pietra Epica, Pietra Leggendaria.");
        $item->setCategory($categorySpecialBox);
         
        $item->setPrices(array("gold"=>50,"warpoints"=>100, "biscuits"=>100));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50272);
        $item->setItemData($metadata);
        $items[] = $item;
        // scatola rara+
        $item = new Metin2Item();
        $item->setName("Scatola Rara+");
        $item->setDesc("Contiene 5 oggetti per UP Epico");
        $item->setCategory($categorySpecialBox);
         
        $item->setPrices(array("gold"=>100,"warpoints"=>200, "biscuits"=>200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(81013);
        $item->setItemData($metadata);
        $items[] = $item;
        // scatola epica+
        $item = new Metin2Item();
        $item->setName("Scatola Epica+");
        $item->setDesc("Contiene 15 oggetti per UP Epico");
        $item->setCategory($categorySpecialBox);
         
        $item->setPrices(array("gold"=>200,"warpoints"=>400, "biscuits"=>400));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(81014);
        $item->setItemData($metadata);
        $items[] = $item;
        // scatola leggendaria+
        $item = new Metin2Item();
        $item->setName("Scatola Leggendaria+");
        $item->setDesc("Contiene 50 oggetti per UP Epico");
        $item->setCategory($categorySpecialBox);
         
        $item->setPrices(array("gold"=>600,"warpoints"=>1200, "biscuits"=>1200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(81015);
        $item->setItemData($metadata);
        $items[] = $item;
        // cambia dottrina
        $item = new Metin2Item();
        $item->setName("Cambia dottrina");
        $item->setDesc("Con questo item puoi cambiare la tua dottrina. Ricorda: le tue abilita' torneranno livello1!");
        $item->setCategory($categorySpecialItem);
         
        $item->setPrices(array("gold"=>1500,"warpoints"=>3000));
		$item->setIsStackable(false);
        $metadata = new Metin2ItemData();
        $metadata->setVnum(71100);
        $item->setItemData($metadata);
        $items[] = $item;
        // cambia regno
        $item = new Metin2Item();
        $item->setName("Cambia Regno");
        $item->setTeaser("Vuoi nuovi amici?");
        $item->setDesc("Ti permette di cambiare regno.");
        $item->setCategory($categorySpecialItem);
        $item->setIsStackable(false);
        $item->setPrices(array("gold"=>75,"warpoints"=>150, "biscuits"=>150));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(71054);
        $item->setItemData($metadata);
        $items[] = $item;

        // incanta oggetto
        $item = new Metin2Item();
        $item->setName("Incantesimo Verde");
        $item->setDesc("Con 5 Incantesimi verde e' possibile cambiare un bonus ad un tuo pezzo di equipaggiamento dall'Artigiano");
        $item->setCategory($categorySpecialItem);
         
        $item->setPrices(array("gold"=>50,"warpoints"=>100, "biscuits"=>100));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(71151);
        $item->setItemData($metadata);
        $items[] = $item;
        // strategia del contrattacco
        $item = new Metin2Item();
        $item->setName("Trattato sulla scherma");
        $item->setTeaser("Item fondamentale per l'epicizzazione.");
        $item->setDesc("Utilizzato insieme a perle bianche, blu e rosse per l'epicizzazione degli oggetti");
        $item->setCategory($categorySpecialItem);
        $item->setIsStackable(false);
        $item->setPrices(array("gold"=>200,"warpoints"=>400, "biscuits"=>400));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(70031);
        $item->setItemData($metadata);
        $items[] = $item;
        // anello exp
        $item = new Metin2Item();
        $item->setName("Anello esperienza (1h)");
        $item->setTeaser("Aumenta il guadagno di EXP");
        $item->setDesc("Raccogli il 50% di punti esperienza in piu'");
        $item->setCategory($categorySpecialItem);
        $item->setIsStackable(false);
        $item->setPrices(array("gold"=>100,"warpoints"=>200, "biscuits"=>200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(70005);
		$metadata->setSocket2(60);
        $item->setItemData($metadata);
        $items[] = $item;
		

        // guerriero deserto uomo
        $item = new Metin2Item();
        $item->setName("Costume Guerriero del Deserto");
        $item->setTeaser("Costume per uomo.");
        $item->setDesc("Questo costume non ha scadenza.");
        $item->setCategory($categoryCostumi);
		$item->setIsStackable(false);
        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(41003);
        $item->setItemData($metadata);
        $items[] = $item;
        // guerriero deserto donna
        $item = new Metin2Item();
        $item->setName("Costume Guerriero del Deserto");
        $item->setTeaser("Costume per donna.");
        $item->setDesc("Questo costume non ha scadenza.");
        $item->setCategory($categoryCostumi);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(41004);
        $item->setItemData($metadata);
        $items[] = $item;
        // costume scherma uomo
        $item = new Metin2Item();
        $item->setName("Costume Scherma");
        $item->setTeaser("Costume per uomo.");
        $item->setDesc("Questo costume non ha scadenza.");
        $item->setCategory($categoryCostumi);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(41005);
        $item->setItemData($metadata);
        $items[] = $item;
        // costume scherma femmina
        $item = new Metin2Item();
        $item->setName("Costume Scherma");
        $item->setTeaser("Costume per donna.");
        $item->setDesc("Questo costume non ha scadenza.");
        $item->setCategory($categoryCostumi);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(41006);
        $item->setItemData($metadata);
        $items[] = $item;
        // maglia calcio uomo
        $item = new Metin2Item();
        $item->setName("Maglia Calcio");
        $item->setTeaser("Costume per uomo.");
        $item->setDesc("Questo costume non ha scadenza.");
        $item->setCategory($categoryCostumi);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(41013);
        $item->setItemData($metadata);
        $items[] = $item;
        // maglia calcio femmina
        $item = new Metin2Item();
        $item->setName("Maglia Calcio");
        $item->setTeaser("Costume per donna.");
        $item->setDesc("Questo costume non ha scadenza.");
        $item->setCategory($categoryCostumi);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(41014);
        $item->setItemData($metadata);
        $items[] = $item;

        // outfit boxe uomo
        $item = new Metin2Item();
        $item->setName("Outfit Boxe");
        $item->setTeaser("Costume per uomo.");
        $item->setDesc("Questo costume non ha scadenza.");
        $item->setCategory($categoryCostumi);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(41013);
        $item->setItemData($metadata);
        $items[] = $item;
        // outfit boxe femmina
        $item = new Metin2Item();
        $item->setName("Outfit Boxe");
        $item->setTeaser("Costume per donna.");
        $item->setDesc("Questo costume non ha scadenza.");
        $item->setCategory($categoryCostumi);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(41014);
        $item->setItemData($metadata);
        $items[] = $item;

        // costume moschettiere uomo
        $item = new Metin2Item();
        $item->setName("Costume Moschettiere");
        $item->setTeaser("Costume per uomo.");
        $item->setDesc("Questo costume non ha scadenza.");
        $item->setCategory($categoryCostumi);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(41017);
        $item->setItemData($metadata);
        $items[] = $item;
        // divisa cameriera femmina
        $item = new Metin2Item();
        $item->setName("Divisa Cameriera");
        $item->setTeaser("Costume per donna.");
        $item->setDesc("Questo costume non ha scadenza.");
        $item->setCategory($categoryCostumi);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(41018);
        $item->setItemData($metadata);
        $items[] = $item;

        // costume moschettiere uomo
        $item = new Metin2Item();
        $item->setName("Abito Salsa");
        $item->setTeaser("Costume per uomo.");
        $item->setDesc("Questo costume non ha scadenza.");
        $item->setCategory($categoryCostumi);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(41119);
        $item->setItemData($metadata);
        $items[] = $item;
        // divisa cameriera femmina
        $item = new Metin2Item();
        $item->setName("Vestito Salsa");
        $item->setTeaser("Costume per donna.");
        $item->setDesc("Questo costume non ha scadenza.");
        $item->setCategory($categoryCostumi);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(41120);
        $item->setItemData($metadata);
        $items[] = $item;

        // sigillo muffin marrone
        $item = new Metin2Item();
        $item->setName("Sigillo Muffin (marrone)");
        $item->setTeaser("Un sigillo davvero bello.");
        $item->setDesc("Grazie a questo sigillo puoi cavalcare un Muffin marrone.");
        $item->setCategory($categoryMount);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(71184);
        $item->setItemData($metadata);
        $items[] = $item;
        // sigillo nugget marrone
        $item = new Metin2Item();
        $item->setName("Sigillo Nugget (marrone)");
        $item->setTeaser("Un sigillo davvero bello.");
        $item->setDesc("Grazie a questo sigillo puoi cavalcare un Nugget marrone.");
        $item->setCategory($categoryMount);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(71185);
        $item->setItemData($metadata);
        $items[] = $item;

        // sigillo muffin blu
        $item = new Metin2Item();
        $item->setName("Sigillo Muffin (blu)");
        $item->setTeaser("Un sigillo davvero bello.");
        $item->setDesc("Grazie a questo sigillo puoi cavalcare un Muffin blu.");
        $item->setCategory($categoryMount);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(71182);
        $item->setItemData($metadata);
        $items[] = $item;
        // sigillo nugget blu
        $item = new Metin2Item();
        $item->setName("Sigillo Nugget (blu)");
        $item->setTeaser("Un sigillo davvero bello.");
        $item->setDesc("Grazie a questo sigillo puoi cavalcare un Nugget blu.");
        $item->setCategory($categoryMount);
		$item->setIsStackable(false);

        $item->setPrices(array("gold"=>500,"warpoints"=>1000, "biscuits"=>1000));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(71183);
        $item->setItemData($metadata);
        $items[] = $item;

        // pietra fondamenta
        $item = new Metin2Item();
        $item->setName("Pietra fondamenta");
        $item->setTeaser("Oggetto per crafting.");
        $item->setDesc("E' possibile creare un Artefatto di Gilda portando una Pietra Fondamenta, Tronco e Compensato da Seon-Pyeong.");
        $item->setCategory($categoryGuildItem);
         
        $item->setPrices(array("gold"=>2,"warpoints"=>4));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(90010);
        $item->setItemData($metadata);
        $items[] = $item;
        // tronco
        $item = new Metin2Item();
        $item->setName("Tronco");
        $item->setTeaser("Oggetto per crafting.");
        $item->setDesc("E' possibile creare un Artefatto di Gilda portando una Pietra Fondamenta, Tronco e Compensato da Seon-Pyeong.");
        $item->setCategory($categoryGuildItem);
         
        $item->setPrices(array("gold"=>2,"warpoints"=>4));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(90011);
        $item->setItemData($metadata);
        $items[] = $item;
        // compensato
        $item = new Metin2Item();
        $item->setName("Compensato");
        $item->setTeaser("Oggetto per crafting.");
        $item->setDesc("E' possibile creare un Artefatto di Gilda portando una Pietra Fondamenta, Tronco e Compensato da Seon-Pyeong.");
        $item->setCategory($categoryGuildItem);
         
        $item->setPrices(array("gold"=>2,"warpoints"=>4));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(90012);
        $item->setItemData($metadata);
        $items[] = $item;


        // diamante
        $item = new Metin2Item();
        $item->setName("Diamante");
        $item->setTeaser("Serve per inserire un nuovo slot nel tuo gioiello.");
        $item->setDesc("La pietra preziosa più dura, che puo' essere utilizzata per creare una nuova montatura.");
        $item->setCategory($categoryOre);
         
        $item->setPrices(array("gold"=>100,"warpoints"=>200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50621);
        $item->setItemData($metadata);
        $items[] = $item;
        // Fiamma rossa
        $item = new Metin2Item();
        $item->setName("Pietra di fiamma rossa");
        $item->setTeaser("Serve per migliorare la tua cinture.");
        $item->setDesc("Puo' essere inserito in una delle tue cinture. Il miglioramento e' permanente.");
        $item->setCategory($categoryOre);
         
        $item->setPrices(array("gold"=>100,"warpoints"=>200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(18900);
        $item->setItemData($metadata);
        $items[] = $item;
        // Argento
        $item = new Metin2Item();
        $item->setName("Argento");
        $item->setTeaser("Serve per migliorare un tuo gioiello.");
        $item->setDesc("Puo' essere inserito in uno dei tuoi gioielli. Il miglioramento e' permanente.");
        $item->setCategory($categoryOre);
         
        $item->setPrices(array("gold"=>100,"warpoints"=>200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50625);
        $item->setItemData($metadata);
        $items[] = $item;
        // Oro
        $item = new Metin2Item();
        $item->setName("Oro");
        $item->setTeaser("Serve per migliorare un tuo gioiello.");
        $item->setDesc("Puo' essere inserito in uno dei tuoi gioielli. Il miglioramento e' permanente.");
        $item->setCategory($categoryOre);
         
        $item->setPrices(array("gold"=>100,"warpoints"=>200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50626);
        $item->setItemData($metadata);
        $items[] = $item;
        // Giada
        $item = new Metin2Item();
        $item->setName("Giada");
        $item->setTeaser("Serve per migliorare un tuo gioiello.");
        $item->setDesc("Puo' essere inserito in uno dei tuoi gioielli. Il miglioramento e' permanente.");
        $item->setCategory($categoryOre);
         
        $item->setPrices(array("gold"=>100,"warpoints"=>200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50627);
        $item->setItemData($metadata);
        $items[] = $item;
        // Ebano
        $item = new Metin2Item();
        $item->setName("Ebano");
        $item->setTeaser("Serve per migliorare un tuo gioiello.");
        $item->setDesc("Puo' essere inserito in uno dei tuoi gioielli. Il miglioramento e' permanente.");
        $item->setCategory($categoryOre);
         
        $item->setPrices(array("gold"=>100,"warpoints"=>200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50628);
        $item->setItemData($metadata);
        $items[] = $item;
        // Perla
        $item = new Metin2Item();
        $item->setName("Perla");
        $item->setTeaser("Serve per migliorare un tuo gioiello.");
        $item->setDesc("Puo' essere inserito in uno dei tuoi gioielli. Il miglioramento e' permanente.");
        $item->setCategory($categoryOre);
         
        $item->setPrices(array("gold"=>100,"warpoints"=>200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50629);
        $item->setItemData($metadata);
        $items[] = $item;
        // Platino
        $item = new Metin2Item();
        $item->setName("Platino");
        $item->setTeaser("Serve per migliorare un tuo gioiello.");
        $item->setDesc("Puo' essere inserito in uno dei tuoi gioielli. Il miglioramento e' permanente.");
        $item->setCategory($categoryOre);
         
        $item->setPrices(array("gold"=>100,"warpoints"=>200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50630);
        $item->setItemData($metadata);
        $items[] = $item;
        // Cristallo
        $item = new Metin2Item();
        $item->setName("Cristallo");
        $item->setTeaser("Serve per migliorare un tuo gioiello.");
        $item->setDesc("Puo' essere inserito in uno dei tuoi gioielli. Il miglioramento e' permanente.");
        $item->setCategory($categoryOre);
         
        $item->setPrices(array("gold"=>100,"warpoints"=>200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50631);
        $item->setItemData($metadata);
        $items[] = $item;
        // Ametista
        $item = new Metin2Item();
        $item->setName("Ametista");
        $item->setTeaser("Serve per migliorare un tuo gioiello.");
        $item->setDesc("Puo' essere inserito in uno dei tuoi gioielli. Il miglioramento e' permanente.");
        $item->setCategory($categoryOre);
         
        $item->setPrices(array("gold"=>100,"warpoints"=>200));
        $metadata = new Metin2ItemData();
        $metadata->setVnum(50632);
        $item->setItemData($metadata);
        $items[] = $item;
 
        $output->writeln("Registrazione item");
        foreach($items as $i){
            $manager->persist($i);
        }
        $manager->flush();
        $output->writeln("Item registrati");
    }
}