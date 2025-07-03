<?php


namespace App\DTO\Tasks;

use Spatie\LaravelData\Data;

class CreateTaskDTO extends Data
{
    public function __construct(
        public ?int   $id,
        public string $title,
        public string $description,
        public array  $extra_data,
        public ?int   $task_status,
        public string $due_date,
        public int    $category_id,
        public int    $type_id,
    ){}
}
