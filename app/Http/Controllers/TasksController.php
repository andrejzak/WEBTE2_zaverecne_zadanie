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
        $tasks = Task::where('student_id', $studentId)->get();
        return view('tasks-accepted', ['tasks' => $tasks]);
    }

    public function showTask($taskId)
    {
        $task = Task::find($taskId);
        return view('task',['task' => $task]);
    }

    public function submitSolution(Request $request, $taskId)
    {
        $request->validate([
            'solution' => 'required|string',
        ]);

        $task = Task::find($taskId);
        if ($task) {
            $solution = $request->input('solution');

            // Extract the equation
            preg_match_all('/\\\\begin{equation\*}(.*?)\\\\end{equation\*}/s', $solution, $matches);
            // Replace mathematical expressions with tags for the LaTeX compiler
            foreach ($matches[0] as $i => $match) {
                $solution = str_replace($match, '\(' . $matches[1][$i] . '\)', $solution);
            }

            $task->student_solution = $solution;
            $task->points_given = 0;
            $task->save();
            
            return redirect()->route('task.show', $taskId)->with('success', 'Solution submitted successfully.');
        } else {
            return redirect()->route('task.show', $taskId)->with('error', 'Task not found.');
        }
    }
}