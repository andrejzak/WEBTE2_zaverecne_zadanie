<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\LatexFileController;
use App\Http\Controllers\TasksController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main');
})->name('main');

Route::get('/guide', function () {
    return view('guide');
})->name('guide');

//routes which should not be accessible when user is logged in
Route::group(['middleware' => 'unauth'], function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::get('/registration', function () {
        return view('registration');
    });
});

//routes for authorized users
Route::group(['middleware' => 'auth'], function () {

    //routes for students
    Route::group(['middleware' => 'role:student'], function () {
        Route::get('/student', [LatexFileController::class, 'showAvailableTaskSets'])->name('student');
        Route::get('/student/generate', function () {return view('student');})->name('student.generate');
        Route::post('/generateRandomTask', [LatexFileController::class, 'generateRandomTask'])->name('generateRandomTask');
        Route::get('/tasks/accepted', [TasksController::class, 'showAcceptedTasks'])->name('tasks.accepted');
        Route::get('/task/{task_id}', [TasksController::class, 'showTask'])->name('task.show');
    });

    //routes for teacher
    Route::group(['middleware' => 'role:teacher'], function () {
        Route::get('/teacher', [LatexFileController::class, 'showFiles'])->name('teacher');
        Route::post('/addFile', [LatexFileController::class, 'addFile'])->name('addFile');
    });
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout-form');

Route::post('/submit-registration', [AuthController::class, 'registration'])->name('registration-form');

Route::post('/submit-login', [AuthController::class, 'login'])->name('login-form');

Route::get('language/{language}', function ($language) {
    if (in_array($language, ['sk', 'en'])) {
        Session::put('applocale', $language);
    }
    return redirect()->back();
})->name('language.change');

Route::get('/export/csv', [ExportController::class, 'exportCsv'])->name('export.csv');
Route::get('/export/pdf', [ExportController::class, 'exportPdf'])->name('export.pdf');

