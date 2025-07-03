<?php

namespace App\Services\TasksService\TasksFactory;
interface TasksFactoryInterface
{
    public function tasks(): TasksInterface;
    public function tasksByCategory(int $filter_id): TasksInterface;
    public function tasksByType(int $filter_id): TasksInterface;
}