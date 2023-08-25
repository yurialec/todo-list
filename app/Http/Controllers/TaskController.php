<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    /**
     * Verify if user is athenticated
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * List all tasks
     *
     * @return void
     */
    public function index()
    {
        $currentUser = Auth::user()->id;
        $tasks = Task::where('user_id', '=', $currentUser)->get();

        if (!empty($tasks)) {
            $taskReturn = TaskResource::collection($tasks);

            return response()->json([
                'status' => 200,
                'message' => 'Success.',
                'tasks' => $taskReturn,
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Sucess',
                'tasks' => [],
            ]);
        }
    }

    /**
     * Create a new Task
     *
     * @param StoreTaskRequest $request
     * @return void
     */
    public function store(StoreTaskRequest $request)
    {
        $data = (object) $request->all();

        if (!empty($data)) {

            $file = $data->attachment;

            if ($file->isValid()) {
                $nameFile = Str::of($data->title)->slug('-') . '.' . $data->attachment->getClientOriginalExtension();
                $image = $data->attachment->storeAs('tasks', $nameFile);
                $data->attachment = $image;
            }

            $currentUser = Auth::user()->id;

            $task = new Task;
            $task->title = $data->title;
            $task->description = $data->description;
            $task->completed = 0;
            $task->dt_created = date("Y-m-d H:i:s");
            $task->dt_completed = NULL;
            $task->dt_updated = NULL;
            $task->deleted_at = NULL;
            $task->user_id = $currentUser;
            $task->attachment = $data->attachment;

            if ($task->save()) {
                $taskReturn = new TaskResource($task);

                return response()->json([
                    'status' => 200,
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
                'message' => 'Insert informations to create a task.',
            ]);
        }
    }

    /**
     * Show detailed Task
     *
     * @param string $id
     * @return void
     */
    public function show(string $id)
    {
        $currentUser = Auth::user()->id;
        $task = Task::where('id', '=', $id)
            ->where('user_id', '=', $currentUser)
            ->get();

        if (!empty($task)) {

            $taskReturn = TaskResource::collection($task);

            return response()->json([
                'status' => 200,
                'message' => 'Succes.',
                'task' => $taskReturn,
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'No results found.',
                'task' => [],
            ]);
        }
    }

    /**
     * Update Task
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function update(Request $request, int $id)
    {
        $data = (object) $request->all();

        if (!empty($data)) {

            $task = Task::find($id);

            if (!empty($task)) {

                if (Storage::exists($task->attachment)) {
                    Storage::delete($task->attachment);
                }

                $file = $data->attachment;

                if ($file->isValid()) {
                    $nameFile = Str::of($data->title)->slug('-') . '.' . $data->attachment->getClientOriginalExtension();
                    $image = $data->attachment->storeAs('tasks', $nameFile);
                    $data->attachment = $image;
                }

                $task->title = $data->title;
                $task->description = $data->description;
                $task->dt_updated = date("Y-m-d H:i:s");
                $task->user_id = 1;
                $task->attachment = $data->attachment;

                try {
                    $task->save();

                    $taskReturn = new TaskResource($task);
                    return response()->json([
                        'status' => 200,
                        'message' => 'Updated Successfully.',
                        'task' => $taskReturn,
                    ]);
                } catch (Exception $err) {
                    // dd($err->getMessage());
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
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Insert informations.',
            ]);
        }
    }

    /**
     * Delete Task
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $task = Task::find($id);

        if (!empty($task)) {

            if ($task->delete()) {
                if (Storage::exists($task->attachment)) {
                    Storage::delete($task->attachment);
                }
                return response()->json([
                    'status' => 200,
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

    public function completeTask(Request $request, int $id)
    {
        $data = $request->all();

        if (!empty($data)) {
            $task = Task::find($id);

            if (!empty($task)) {

                $task->completed = $data['completed'];
                $task->dt_updated = date("Y-m-d H:i:s");
                $task->dt_completed = date("Y-m-d H:i:s");

                try {
                    $task->save();

                    $taskReturn = new TaskResource($task);

                    return response()->json([
                        'status' => 200,
                        'message' => 'Task completed Successfully.',
                        'task' => $taskReturn,
                    ]);
                } catch (Exception $err) {
                    // dd($err->getMessage());
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
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Insert informations.',
            ]);
        }
    }
}
