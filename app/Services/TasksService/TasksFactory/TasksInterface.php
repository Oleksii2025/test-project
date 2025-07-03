<?php

namespace App\Services\TasksService\TasksFactory;

interface TasksInterface
{
    public function getUserId(): int;

    public function getTasks(): array;
}