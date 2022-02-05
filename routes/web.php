<?php

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


// Logintegister
Route::get('/studentlogin', function () {
    return view('auth.studentlogin');
});
Route::get('/studentregister', function () {
    return view('auth.studentregister');
});
Route::get('/teacherlogin', function () {
    return view('auth.teacherlogin');
});
Route::get('/teacherregister', function () {
    return view('auth.teacherregister');
});
// 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
