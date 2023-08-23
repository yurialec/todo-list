<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::paginate();
        return TaskResource::collection($tasks);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $task = Task::create($data);

        return new TaskResource($task);
    }
}
