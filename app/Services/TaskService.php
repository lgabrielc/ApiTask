<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{

    public function getAllTasks()
    {
        return Task::all();
    }
    public function createTask($data)
    {
        return Task::create($data);
    }
    public function updateTask($id, $data)
    {
        $task = Task::where();
    }
}
