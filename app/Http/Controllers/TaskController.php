<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * List all tasks
     *
     * @return void
     */
    public function index()
    {
        $tasks = Task::all();

        if (!empty($tasks)) {
            $taskReturn = TaskResource::collection($tasks);

            return response()->json([
                'status' => 204,
                'message' => 'Success.',
                'tasks' => $taskReturn,
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Erro',
            ]);
        }
    }

    public function store(StoreTaskRequest $request)
    {
        $data = $request->all();

        if (!empty($data)) {
            $task = Task::create($data);
            if ($task) {
                $taskReturn = new TaskResource($task);

                return response()->json([
                    'status' => 204,
                    'message' => 'Created Successfully.',
                    'task' => $taskReturn,
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Try again later.',
                ]);
            }
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Insert informations.',
            ]);
        }
    }

    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $data = $request->all();

        if (!empty($data)) {
            $task = Task::find($id);

            if ($task->update()) {

                $taskReturn = new TaskResource($task);

                return response()->json([
                    'status' => 204,
                    'message' => 'Updated Successfully.',
                    'task' => $taskReturn,
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Try again later.',
                ]);
            }
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Insert informations.',
            ]);
        }


        $task = Task::findOrFail($id);
        $task->update($data);
        return new TaskResource($task);
    }

    public function delete(int $id)
    {
        $task = Task::find($id);

        if (!empty($task->exists)) {

            if ($task->delete()) {
                return response()->json([
                    'status' => 204,
                    'message' => 'Deleted Successfully.',
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Try again later.',
                ]);
            }
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Task not found.',
            ]);
        }
    }
}
