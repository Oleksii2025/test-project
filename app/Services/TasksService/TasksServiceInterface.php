<?php

namespace App\Services\TasksService;

interface TasksServiceInterface
{
    public function getTasks(array $filteringOptions): array;

    public function getTask(int $id): object;

    public function createTask(object $data): bool;

    public function editTask(object $data): bool;

    public function destroy(int $id): void;
}
