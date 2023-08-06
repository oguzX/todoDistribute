<?php

namespace App\Service\Provider;

use App\Type\ProviderHandler;
use GuzzleHttp\Client;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class Provider
{
    protected $apiUrl;

    /**
     * @param $apiUrl
     */
    public abstract function __construct();

    protected abstract function create($providerTaskData): ProviderHandler;

    protected function fetch()
    {
        $this->client = new Client([
            'timeout' => 2.0
        ]);
        $request = $this->client->request('get', $this->apiUrl);

        if (!$request->getBody()){
            throw new NotFoundHttpException('Not found');
        }
        return $request->getBody() ? json_decode($request->getBody()->getContents()): [];
    }

    public function getTasks(): array
    {
        $objectArr = [];

        foreach ($this->fetch() as $task){
            $taskData = $this->create($task);
            $objectArr[] = $taskData->toTask();
        }
        return $objectArr;
    }

}