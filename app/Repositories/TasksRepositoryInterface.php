<?php

namespace App\Repositories;

interface TasksRepositoryInterface
{
    public function getAllTasks(int $user_id): array;
    public function GetTasksByCategory(int $user_id, int $category_id,): array;
    public function GetTasksByType(int $user_id, int $type_id): array;
    public function getTask(int $user_id): object;
    public function store(object $data): bool;
    public function update(object $data): bool;
}
