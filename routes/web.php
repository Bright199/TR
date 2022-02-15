<?php

use App\Http\Controllers\StudentRegistration;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('student')->name('student.')->group(function(){
    Route::middleware(['guest:student'])->group(function(){
        Route::view('/login', 'student.login')->name('login');
        Route::post('/login', [StudentRegistration::class,'login'])->name('login');
        Route::view('/register', 'student.register')->name('register');
        Route::post('/register',[StudentRegistration::class,'store'])->name('register');
    }); 
    Route::middleware(['auth:student'])->group(function(){
        Route::view('/dashboard','student.dashboard')->name('dashboard');
        Route::post('/logout',[StudentRegistration::class,'logout'])->name('logout');
    });
});
// Loginstudent
// Route::get('/loginstudent', [StudentRegistration::class,'index'])->name('loginstudent');

// // StudentDashboard
// Route::get('/studentdashboard',[StudentRegistration::class,'studentdashboard'])->middleware('auth');

// // Register studentregister
// Route::get('/registerstudent',[StudentRegistration::class,'create'])->name('registerstudent');



Route::get('/teacherlogin', function () {
    return view('teacher.teacherlogin');
});
Route::get('/teacherregister', function () {
    return view('teacher.teacherregister');
});
// 

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
