<?php

namespace App\Http\Repositories;

interface TasksRepositoryInterface
{
    public function getAllTasks(): array;
}