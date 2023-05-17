<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Task;

class TasksController extends Controller
{
    public function showAcceptedTasks()
    {
        $studentId = auth()->user()->id;
        $tasks = Task::where('student_id', $studentId)->whereNull('points_given')->get();
        return view('tasks-accepted', ['tasks' => $tasks]);
    }

    public function showTask($taskId)
    {
        $task = Task::find($taskId);
        return view('task',['task' => $task]);
    }
}