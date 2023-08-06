<?php

namespace App\Service\Decorate;

use App\Entity\Task;

class Developer
{
    /**
     * @param \App\Entity\Developer $developer
     * @return array
     */
    public function getDeveloperTasksByWeekGroup(\App\Entity\Developer $developer)
    {
        $decoratedTasks= [];

        /** @var Task $task */
        foreach ($developer->getTasks() as $task){
            $decoratedTasks[$task->getWeek()][] = $task;
        }

        return $decoratedTasks;
    }
}