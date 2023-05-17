<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';

    protected $fillable = [
        'latex_file_id',
        'student_id',
        'task_id',
        'task',
        'points_max',
        'points_given',
        'task_image',
        'solution'
    ];
}
