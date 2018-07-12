<?php


namespace App\Command;


use App\Document\MoneyGrabber;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateGrabbersCommand extends Command {
    protected $registry;
    public function __construct(ManagerRegistry $registry) {
        $this->registry = $registry;
        parent::__construct();
    }

    public function configure() {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('shop:generate-default-perdi-tutto-grabbers')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output) {

        $manager = $this->registry->getManager();
        $manager->getDocumentCollection(MoneyGrabber::class)->drop();
        $peppeMoneygrabber = new MoneyGrabber();
        $peppeMoneygrabber->setEmail('giuseppealfiero95@gmail.com');
        $peppeMoneygrabber->setPercentage(0.6);
        $manager->persist($peppeMoneygrabber);

        $amineMoneygrabber = new MoneyGrabber();
        $amineMoneygrabber->setEmail('amine.lajaji@hotmail.com');
        $amineMoneygrabber->setPercentage(0.3);
        $manager->persist($amineMoneygrabber);

        $amineMoneygrabber = new MoneyGrabber();
        $amineMoneygrabber->setEmail('ninni.drago@gmail.com');
        $amineMoneygrabber->setEarnings(10);
        $amineMoneygrabber->setPercentage(0.1);
        $manager->persist($amineMoneygrabber);

        $manager->flush();
        $output->writeln("Generati i moneygrabber");
    }
}