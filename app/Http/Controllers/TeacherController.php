<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Task;
use App\Models\User;

class TeacherController extends Controller
{
    public function showStudentOverview()
    {
        $students = User::where('role', 'student')->get()->map(function ($student) {
            $student->generated_tasks = Task::where('student_id', $student->id)->count();
            $student->submitted_tasks = Task::where('student_id', $student->id)->whereNotNull('points_given')->count();
            $student->total_points = Task::where('student_id', $student->id)->whereNotNull('points_given')->sum('points_given');
            return $student;
        });
        return view('teacher-students-overview', ['students' => $students]);
    }

    public function showStudentDetail($id)
    {
        $student = User::find($id);
        $tasks = Task::where('student_id', $id)->get();
        
        return view('student-detail', ['student' => $student, 'tasks' => $tasks]);
    }

    public function showTaskDetail($taskId)
    {
        $task = Task::find($taskId);
        $student = User::find($task->student_id);
        return view('task-teacher-detail', ['student' => $student, 'task' => $task]);
    }
}