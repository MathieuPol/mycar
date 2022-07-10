<?php

namespace App\Command;

use App\Repository\CarRepository;
use App\Services\MySlugger;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CarSlugUpdateCommand extends Command
{
    protected static $defaultName = 'app:car:slug-update';
    protected static $defaultDescription = 'Utilisez cette commande pour mettre à jour les slugs des véhicules de la bdd';

    /**
     * Service de slugger
     * @var MySlugger
     */
     private $slugger;

     /**
      * Repository car
      * @var CarRepository
      */
    private $carRepository;

    /**
     * Service Manager registry
     * @var ManagerRegistry
     */
     private $managerRegistry;

     /**
      * Constructeur
      * @param MySlugger $slugger
      * @param CarRepository $carRepository
      * @param ManagerRegistry $managerRegistry
      */
    public function __construct(MySlugger $slugger, CarRepository $carRepository, ManagerRegistry $managerRegistry)
    {
        parent::__construct();

        $this->slugger = $slugger;
        $this->carRepository = $carRepository;
        $this->managerRegistry = $managerRegistry;
    }

    protected function configure(): void
    {
        //ici pas besoin d'options
/*         $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ; */
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Mise à jour des slugs des véhicules');

        $cars = $this->carRepository->findAll();

        foreach ($cars as $car) {
            $car->setSlug($this->slugger->slug($car->getModele()));
        };

        $manager = $this->managerRegistry->getManager();
        $manager->flush();

        $io->success('Mise à jour des slugs des véhicules effectuée');


        return Command::SUCCESS;
    }
}
