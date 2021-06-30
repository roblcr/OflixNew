<?php

namespace App\Command;

use App\Repository\TvShowRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\String\Slugger\SluggerInterface;

class TvshowSluggerCommand extends Command
{
    protected static $defaultName = 'tvshow:slugger';
    protected static $defaultDescription = 'Creation de slugs pour une ou plusieurs séries';
    private $tvShowRepository;
    private $sluggerInterface;
    private $entityManager;

    public function __construct(SluggerInterface $slugger, EntityManagerInterface $entityManager, TvShowRepository $tvShowRepository)
    {
        $this->slugger = $slugger;
        $this->entityManager = $entityManager;
        $this->tvShowRepository =$tvShowRepository;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('tvShowId', InputArgument::OPTIONAL, 'identifiant de la série')
            ->addOption('updatedAt', null, InputOption::VALUE_NONE, 'mise a jour de la propriété updatedAt')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
         $tvShowId = $input->getArgument('tvShowId');

         if ($tvShowId) {
             $io->note(sprintf('You passed an argument: %s', $tvShowId));
         }

         if ($input->getOption('option1')) {
             // ...
         }

        // 1) on va récupérer la ou les séries a mettre a jour
            
            $tvShowList = $this->tvShowRepository->findAll();

        // 2) pour chaque série on récupère le title
            foreach($tvShowList as $tvShow) {
                $title = $tvShow->getTitle();
                // 3) on génère le slug avec le service 
                $slug = $this->slugger->slug($title);
                
                 // 4) on met a jour la propriété slug

                 $tvShow->setSlug(strtolower($slug));

            }
        

       

        // 5) on ajoute en BDD avec flusg

        $this->entityManager->flush();

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
