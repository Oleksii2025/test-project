<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Task;

class TasksRepository implements TasksRepositoryInterface
{
    /**
     * @param int $user_id
     * @return array
     */
    public function getAllTasks(int $user_id): array
    {
        return Task::where('user_id', $user_id)->get()->toArray();
    }

    /**
     * @param int $user_id
     * @param int $category_id
     * @return array
     */
    public function getTasksByCategory(int $user_id, int $category_id): array
    {
        return Task::where('user_id', $user_id)->whereHas('categories', function (Builder $query) use ($category_id) {
            $query->where('category_id', $category_id);
        })->get()->toArray();
    }

    /**
     * @param int $user_id
     * @param int $type_id
     * @return array
     */
    public function GetTasksByType(int $user_id, int $type_id): array
    {
        return Task::where('user_id', $user_id)->whereHas('types', function (Builder $query) use ($type_id) {
            $query->where('type_id', $type_id);
        })->get()->toArray();
    }

    /**
     * @param int $id
     * @return object
     */
    public function getTask(int $id): object
    {
        $data = Task::where('id', $id)->first();
        $data->categories->isNotEmpty();
        $data->types->isNotEmpty();
        return $data;
    }

    /**
     * @param object $data
     * @return bool
     */
    public function store(object $data): bool
    {
        try {
            $task = new Task();
            $task->user_id = $data->user_id;
            $task->title = $data->title;
            $task->description = $data->description;
            $task->extra_data = $data->extra_data;
            $task->task_status = $data->task_status;
            $task->due_date = $data->due_date;
            $task->save();
            $lastAdded = Task::all()->last()->id;
            $task->categories()->attach($lastAdded, ['category_id' => $data->category_id, 'task_id' => $lastAdded]);
            $task->types()->attach($lastAdded, ['type_id' => $data->type_id, 'task_id' => $lastAdded]);

            return true;

        } catch (\Throwable $th) {

            return false;
        }
    }

    /**
     * @param object $data
     * @return bool
     */
    public function update(object $data): bool
    {
        try {
            $task = $this->getTask($data->id);
            $task->user_id = $data->user_id;
            $task->title = $data->title;
            $task->description = $data->description;
            $task->extra_data = $data->extra_data;
            $task->task_status = $data->task_status;
            $task->due_date = $data->due_date;
            $task->save();
            $lastAdded = Task::all()->last()->id;
            $task->categories()->sync([$data->category_id]);
            $task->categories()->sync([$data->type_id]);

            return true;

        } catch (\Throwable $th) {

            return false;
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $task = $this->getTask($id);
        $task->categories()->detach();
        $task->types()->detach();
        $task->delete();
    }
}
