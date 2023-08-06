<?php

namespace App\Service\Provider;

use App\Type\ProviderHandler;
use App\Utility\HashGenerator;

class Provider2 extends Provider
{
    public function __construct()
    {
        $this->apiUrl = 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7';
    }

    public function create($providerTaskData): ProviderHandler
    {
        foreach ($providerTaskData as $key => $task){
            $providerTask = new ProviderHandler();
            $providerTask->setTitle($key);
            $providerTask->setEstimateDay($task->estimated_duration);
            $providerTask->setLevel($task->level);
            $providerTask->setHash(HashGenerator::create(self::class, $key));
        }

        return $providerTask;
    }

//    public function getTasks(): array
//    {
//        $objectArr = [];
//        foreach ($this->fetch() as $key => $task){
//            $task->id = $key;
//            $taskData = $this->create($task);
//            $objectArr[] = $taskData;
//        }
//
//        return $objectArr;
//    }

}