<?php

namespace App\Services\TasksService;

use App\Repositories\TasksRepositoryInterface;
use App\Services\TasksService\TasksFactory\TasksFactoryInterface;
use Illuminate\Support\Facades\Auth;
use App\DTO\Tasks\StoreTaskDTO;
use stdClass;

class TasksService implements TasksServiceInterface
{
    /**
     * @param TasksRepositoryInterface $tasksRepository
     * @param TasksFactoryInterface $tasksFactory
     */
    public function __construct(private TasksRepositoryInterface $tasksRepository, private TasksFactoryInterface $tasksFactory)
    {
    }

    /**
     * @param array $filteringOptions
     * @return array
     */
    public function getTasks(array $filteringOptions): array
    {
        $tasks = match ($filteringOptions['title']) {
            'list' => $this->tasksFactory->tasks(),
            'category' => $this->tasksFactory->tasksByCategory($filteringOptions['id']),
            'type' => $this->tasksFactory->tasksByType($filteringOptions['id']),
        };

        return $tasks->getTasks();
    }

    /**
     * @param int $id
     * @return object
     */
    public function getTask(int $id): object
    {
        $data = $this->tasksRepository->getTask($id);

        return $data;
    }

    /**
     * @param object $data
     * @return bool
     */
    public function createTask(object $data): bool
    {
        try {
            $taskData = new StdClass();
            $taskData->user_id = Auth::id();
            $taskData->title = htmlspecialchars($data->title, ENT_QUOTES);
            $taskData->description = htmlspecialchars($data->description, ENT_QUOTES);
            $taskData->extra_data = json_encode($data->extra_data);
            $taskData->task_status = 0;
            $taskData->due_date = $data->due_date;
            $taskData->category_id = $data->category_id;
            $taskData->type_id = $data->type_id;
            $save = $this->tasksRepository->store(StoreTaskDTO::from($taskData));

            return $save;
        } catch (\Throwable $th) {

            return false;
        }
    }

    /**
     * @param object $data
     * @return bool
     */
    public function editTask(object $data): bool
    {
        try {
            $taskData = new StdClass();
            $taskData->id = $data->id;
            $taskData->user_id = Auth::id();
            $taskData->title = htmlspecialchars($data->title, ENT_QUOTES);
            $taskData->description = htmlspecialchars($data->description, ENT_QUOTES);
            $taskData->extra_data = json_encode($data->extra_data);
            $taskData->task_status = $data->task_status;
            $taskData->due_date = $data->due_date;
            $taskData->category_id = $data->category_id;
            $taskData->type_id = $data->type_id;
            $save = $this->tasksRepository->update(StoreTaskDTO::from($taskData));

            return $save;
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
        $this->tasksRepository->destroy($id);
    }
}
