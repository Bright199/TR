<?php

use App\Http\Controllers\SocialiteLogin;
use App\Http\Controllers\StudentRegistration;
use App\Http\Controllers\TeacherSocialiteLogin;
use App\Http\Controllers\TeachersRegistration;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
Route::get('/teacher/home', function () {
    return view('teacher.home');
});
Route::get('/student/home', function () {
    return view('student.home');
});

// Student registration system
Route::prefix('student')->name('student.')->group(function () {
    Route::middleware(['guest:student'])->group(function () {
        // Route::view('/login', 'student.login')->name('login');
        Route::get('/login',[StudentRegistration::class, 'loginForm'])->name('login');
        Route::post('/login', [StudentRegistration::class, 'login'])->name('login');
        Route::view('/register', 'student.register')->name('register');
        Route::post('/register', [StudentRegistration::class, 'store'])->name('register');
    });
    Route::middleware(['auth:student'])->group(function () {
        Route::view('/dashboard', 'student.dashboard')->name('dashboard');
        Route::post('/logout', [StudentRegistration::class, 'logout'])->name('logout');
        Route::get('/logout', [StudentRegistration::class, 'logout'])->name('logout');
        Route::get('/getAuthUser', [StudentRegistration::class, 'getAuthUser']);
        Route::get('/edit/profile', [StudentRegistration::class, 'EditStudentProfile']);
        Route::post('/edit', [StudentRegistration::class, 'EditProfile']);
        Route::post('/delete/account', [StudentRegistration::class, 'DeleteProfile']);
        Route::post('/profile/check', [StudentRegistration::class, 'CheckProfileInfo']);
        Route::post('/ad/save', [StudentRegistration::class, 'AdSave']);
        Route::get('/ads', [StudentRegistration::class, 'GetAds']);
        Route::get('/create/ad', function(){
            return view('student.ad');
        });
        Route::get('/ad/management', function(){
            return view('student.adsmanagement');
        });
    });
});


// Teachers registration system
Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::middleware(['guest:teacher'])->group(function () {
        Route::view('/login', 'teacher.login')->name('login');
        Route::post('/login', [TeachersRegistration::class, 'login'])->name('login');
        Route::view('/register', 'teacher.register')->name('register');
        Route::post('/register', [TeachersRegistration::class, 'store'])->name('register');
    });
    Route::middleware(['auth:teacher'])->group(function () {
        Route::view('/dashboard', 'teacher.dashboard')->name('dashboard');
        Route::post('/logout', [TeachersRegistration::class, 'logout'])->name('logout');
        Route::get('/logout', function(){
            return view('/dashboard');
        });
    });
});

// Socialite for students
Route::get('facebook/auth/redirect', function () {
    return Socialite::driver('facebook')->redirect();
})->name('student.facebook.login');
Route::get('facebook/auth/callback', [SocialiteLogin::class, 'facebook']);


Route::get('google/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('student.google.login');
Route::get('google/auth/callback', [SocialiteLogin::class, 'google']);

// // socialite for teachers
// Route::get('facebook/auth/redirect', function () {
//     return Socialite::driver('facebook')->redirect();
// })->name('teacher.facebook.login');
// Route::get('facebook/auth/callback', [TeacherSocialiteLogin::class, 'teacherFacebook']);


// Route::get('google/auth/redirect', function () {
//     return Socialite::driver('google')->redirect();
// })->name('teacher.google.login');
// Route::get('google/auth/callback', [TeacherSocialiteLogin::class, 'teacherGoogle']);





Auth::routes();
