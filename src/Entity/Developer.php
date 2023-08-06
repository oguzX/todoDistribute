<?php

namespace App\Entity;

use App\Entity\Traits\TimeStampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="delevopers")
 * @ORM\Entity(repositoryClass="App\Repository\DeveloperRepository")
 * @ORM\HasLifecycleCallbacks()
*/
class Developer
{
    use TimeStampableTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $weeklyCapacity;

    /**
     * @ORM\Column(type="integer")
     */
    private $weeklyCurrentCapacity;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="developer", fetch="EXTRA_LAZY")
     */
    private $tasks;

    private $tmpWeeklyCapacity;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getWeeklyCapacity()
    {
        return $this->weeklyCapacity;
    }

    /**
     * @param mixed $weeklyCapacity
     */
    public function setWeeklyCapacity($weeklyCapacity): void
    {
        $this->weeklyCapacity = $weeklyCapacity;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTasks(): ?object
    {
        return $this->tasks;
    }

    /**
     * @param string $tasks
     */
    public function setTasks(string $tasks): void
    {
        $this->tasks = $tasks;
    }

    /**
     * @return mixed
     */
    public function getWeeklyCurrentCapacity()
    {
        return $this->weeklyCurrentCapacity;
    }

    /**
     * @param mixed $weeklyCurrentCapacity
     */
    public function setWeeklyCurrentCapacity($weeklyCurrentCapacity): void
    {
        $this->weeklyCurrentCapacity = $weeklyCurrentCapacity;
    }


    public function addTask(Task $task)
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setDeveloper($this);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTmpWeeklyCapacity()
    {
        return $this->tmpWeeklyCapacity;
    }

    /**
     * @param mixed $tmpWeeklyCapacity
     */
    public function setTmpWeeklyCapacity($tmpWeeklyCapacity): void
    {
        $this->tmpWeeklyCapacity = $tmpWeeklyCapacity;
    }



}