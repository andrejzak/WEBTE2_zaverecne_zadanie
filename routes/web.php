<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/guide', function () {
    return view('guide');
});

Route::get('/student', function () {
    return view('student');
})->name('student');

Route::get('/teacher', function () {
    return view('teacher');
})->name('teacher');

Route::get('/registration', function () {
    return view('registration');
});

Route::post('/submit-registration', [AuthController::class, 'registration'])->name('registration');

Route::post('/submit-login', [AuthController::class, 'login'])->name('login');

Route::get('language/{language}', function ($language) {
    if (in_array($language, ['sk', 'en'])) {
        Session::put('applocale', $language);
    }
    return redirect()->back();
})->name('language.change');

Route::get('/export/csv', [ExportController::class, 'exportCsv'])->name('export.csv');
Route::get('/export/pdf', [ExportController::class, 'exportPdf'])->name('export.pdf');
