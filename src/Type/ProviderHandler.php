<?php

namespace App\Type;

use App\Entity\Task;

class ProviderHandler{
    public $title;
    public $estimateDay;
    public $level;
    public $hash;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getEstimateDay()
    {
        return $this->estimateDay;
    }

    /**
     * @param mixed $estimateDay
     */
    public function setEstimateDay($estimateDay): void
    {
        $this->estimateDay = $estimateDay;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level): void
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param mixed $hash
     */
    public function setHash($hash): void
    {
        $this->hash = $hash;
    }

    public function toTask()
    {
        $task = new Task();
        $task->setTitle($this->getTitle());
        $task->setEstimateDays($this->getEstimateDay());
        $task->setLevel($this->getLevel());
        $task->setHash($this->getHash());

        return $task;
    }


}