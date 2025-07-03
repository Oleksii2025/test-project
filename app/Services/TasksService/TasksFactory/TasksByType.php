<?php

namespace App\Services\TasksService\TasksFactory;

use Illuminate\Support\Facades\Auth;

class TasksByType implements TasksInterface
{
    public function __construct(private $tasksRepository, public int $filter_id)
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
        return $this->tasksRepository->getTasksByType($this->getUserId(), $this->filter_id);
    }
}
