<?php

namespace App\Http\Services\TasksService;
use App\Repositories\TasksRepository\TasksRepositoryInterface;

class TasksService implements TaskServiceInterface
{
    public function __construct(TasksRepositoryInterface $tasksRepositoryInterface) {}

    public function getAllTasks(): array
    {

    }
}