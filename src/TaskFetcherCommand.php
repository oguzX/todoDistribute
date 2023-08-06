<?php

namespace App;

use App\Service\Provider\Provider1;
use App\Service\Provider\Provider2;
use App\Service\Task\DistributeService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TaskFetcherCommand extends Command
{

    /**
     * @var DistributeService
     */
    private $distributeService;

    public function __construct(DistributeService $distributeService)
    {
        parent::__construct();
        $this->distributeService = $distributeService;
    }

    protected function configure()
    {
        $this->setName('task:fetch')
        ->setDescription('This Command is used to distribute tasks from Providers to developers');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $providers = [
            new Provider1(),
            new Provider2()
        ];

        $allTasks = [];
        foreach ($providers as $provider){
            $allTasks = array_merge($allTasks, $provider->getTasks());
        }

        $this->distributeService->distributeAllTasks($allTasks);



        return false;
    }

}