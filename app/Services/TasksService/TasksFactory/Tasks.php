<?php

namespace App\Services\TasksService\TasksFactory;

use Illuminate\Support\Facades\Auth;

class Tasks implements TasksInterface
{
    /**
     * @param $tasksRepository
     */
    public function __construct(private $tasksRepository)
    {
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return Auth::id();
    }

    /**
     * @return array
     */
    public function getTasks(): array
    {
        return $this->tasksRepository->getAllTasks($this->getUserId());
    }
}
