<?php


namespace App\DTO\Tasks;

use Spatie\LaravelData\Data;

class StoreTaskDTO extends Data
{
    public function __construct(
        public ?int   $id,
        public int    $user_id,
        public string $title,
        public string $description,
        public string $extra_data,
        public int    $task_status,
        public string $due_date,
        public int    $category_id,
        public int    $type_id,
    ){}
}
