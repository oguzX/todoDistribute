<?php

namespace App\Service\Task;

use App\Entity\Developer;
use App\Entity\Task;
use App\Type\ProviderHandler;
use Doctrine\ORM\EntityManagerInterface;

class DistributeService
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return float|int|mixed[]|string
     */
    private function getAssignedTasks()
    {
        return $this->entityManager->getRepository(Task::class)->getTaskHash();
    }

    /**
     * @param $tasks
     * @return void
     */
    public function distributeAllTasks($tasks)
    {
        $getLastWeek = $this->entityManager->getRepository(Task::class)->getLastWeek();
        $this->resetDevelopersCapacity();
        $this->distributeTasks($tasks, ++$getLastWeek);

        if (count($tasks) > 0)
            $this->distributeAllTasks($tasks);

        return true;
    }

    public function distributeTasks(&$tasks, $week)
    {
        $developers = $this->entityManager->getRepository(Developer::class)->findBy(['deletedAt' => null]);
        $taskHashes = $this->getAssignedTasks();
        foreach ($tasks as $key => $task){
            if (in_array($task->getHash(), $taskHashes)){
                unset($tasks[$key]);
                continue;
            }
            $index = $key % count($developers);
            /** @var Developer $developer */
            $developer = $developers[$index];

            $effort = $task->getEstimateDays() * $task->getLevel();

            if($developer->getWeeklyCurrentCapacity() >= $effort){
                $task->setWeek($week);
                $task->setDeveloper($developer);
                $developer->setWeeklyCurrentCapacity($developer->getWeeklyCurrentCapacity()-$effort);
                unset($tasks[$key]);

                $this->entityManager->persist($task);
                $this->entityManager->flush();
            }
        }

        $this->entityManager->clear();
    }

    /**
     * @return void
     */
    private function resetDevelopersCapacity()
    {
        $this->entityManager->getRepository(Developer::class)->resetDeveloperWeeklyCapacity();
    }
}
