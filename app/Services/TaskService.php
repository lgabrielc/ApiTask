<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TaskService
{

    public function getAllTasks()
    {
        return Task::all();
    }

    public function createTask($data)
    {
        $validator = Validator::make(
            $data,
            [
                'title' => 'required|string',
                'description' => 'required|string',
                'due_date' => 'required|date',
                'user_id' => 'required|exists:users,id',
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        return Task::create($data);
    }

    public function getTaskById($id)
    {
        return Task::findOrFail($id);
    }

    public function updateTask($id, $data)
    {
        $task = Task::findOrFail($id);

        $validator = Validator::make(
            $data,
            [
                'title' => 'required|string',
                'description' => 'required|string',
                'due_date' => 'required|date',
                'user_id' => 'required|exists:users,id',
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $task->update($data);
        return $task;
    }
    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }
}
