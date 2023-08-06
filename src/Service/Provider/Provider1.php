<?php

namespace App\Service\Provider;

use App\Type\ProviderHandler;
use App\Utility\HashGenerator;

class Provider1 extends Provider
{
    public function __construct()
    {
        $this->apiUrl = 'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa';
    }

    public function create($providerTaskData): ProviderHandler
    {
        $providerTask = new ProviderHandler();
        $providerTask->setTitle($providerTaskData->id);
        $providerTask->setEstimateDay($providerTaskData->sure);
        $providerTask->setLevel($providerTaskData->zorluk);
        $providerTask->setHash(HashGenerator::create(self::class, $providerTaskData->id));

        return $providerTask;
    }

//    public function getTasks(): array
//    {
//        $objectArr = [];
//        foreach ($this->fetch() as $task){
//            $objectArr[] = $this->create($task);
//        }
//
//        return $objectArr;
//    }
}