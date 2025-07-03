<?php

namespace App\Services\TasksService\TasksFactory;

use App\Repositories\TasksRepositoryInterface;

class TasksFactory implements TasksFactoryInterface
{
    /**
     * @param TasksRepositoryInterface $tasksRepository
     */
    public function __construct(private TasksRepositoryInterface $tasksRepository)
    {
    }

    /**
     * @return TasksInterface
     */
    public function tasks(): TasksInterface
    {
        return new Tasks($this->tasksRepository);
    }

    /**
     * @param $filter_id
     * @return TasksInterface
     */
    public function tasksByCategory($filter_id): TasksInterface
    {
        return new TasksByCategory($this->tasksRepository, $filter_id);
    }

    /**
     * @param $filter_id
     * @return TasksInterface
     */
    public function tasksByType($filter_id): TasksInterface
    {
        return new TasksByType($this->tasksRepository, $filter_id);
    }
}
