<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TasksService\TasksServiceInterface;
use App\DTO\Tasks\CreateTaskDTO;

class TasksController extends Controller
{
    /**
     * @param TasksServiceInterface $tasksService
     */
    public function __construct(private TasksServiceInterface $tasksService)
    {
    }

    /**
     * @param Request $request
     * @return object|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request): object
    {
        $data = $this->tasksService->getTasks($request->only(['id', 'title']));

        return response()->json(['data' => $data], 200);

    }

    /**
     * @param Request $request
     * @return object
     */
    public function store(Request $request): object
    {
        $taskDTO = CreateTaskDTO::from($request->only(
            [
                'title',
                'description',
                'extra_data',
                'due_date',
                'category_id',
                'type_id',
            ])
        );
        $response = $this->tasksService->createTask($taskDTO);

        return response()->json(['data' => $response], 200);
    }

    /**
     * @param string $id
     * @return object|\Illuminate\Http\JsonResponse
     */
    public function show(string $id): object
    {
        $data = $this->tasksService->getTask((int)$id);

        return response()->json(['data' => $data], 200);
    }

    /**
     * @param Request $request
     * @return object|\Illuminate\Http\JsonResponse
     */
    public function edit(Request $request): object
    {
        $taskDTO = CreateTaskDTO::from($request->only(
            [
                'id',
                'title',
                'description',
                'extra_data',
                'task_status',
                'due_date',
                'category_id',
                'type_id',
            ])
        );
        $response = $this->tasksService->editTask($taskDTO);

        return response()->json(['data' => $response], 200);
    }

    /**
     * @param string $id
     * @return object|\Illuminate\Http\JsonResponse
     */
    public function destroy(string $id): object
    {
        $this->tasksService->destroy((int)$id);

        return response()->json(['message' => 'success'], 200);
    }
}
