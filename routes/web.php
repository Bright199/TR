<?php

use App\Http\Controllers\PaidLessonController;
use App\Http\Controllers\SocialiteLogin;
use App\Http\Controllers\StudentRegistration;
use App\Http\Controllers\TeacherSocialiteLogin;
use App\Http\Controllers\TeachersRegistration;
use Illuminate\Support\Facades\Auth;
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
        Route::get('/login', [StudentRegistration::class, 'loginForm'])->name('login');
        Route::post('/login', [StudentRegistration::class, 'login'])->name('login');
        Route::view('/register', 'student.register')->name('register');
        Route::post('/register', [StudentRegistration::class, 'store'])->name('register');
    });
    Route::middleware(['auth:student'])->group(function () {
        Route::view('/dashboard', 'student.dashboard')->name('dashboard');
        Route::post('/logout', [StudentRegistration::class, 'logout'])->name('logout');
        Route::get('/logout', [StudentRegistration::class, 'logout'])->name('logout');
        Route::get('/getAuthUser', [StudentRegistration::class, 'getAuthUser']);
        Route::get('/getReceivedMessages', [StudentRegistration::class, 'getReceivedMessages']);
        Route::get('/edit/profile', [StudentRegistration::class, 'EditStudentProfile']);
        Route::post('/edit', [StudentRegistration::class, 'EditProfile']);
        Route::post('/delete/account', [StudentRegistration::class, 'DeleteProfile']);
        Route::post('/profile/check', [StudentRegistration::class, 'CheckProfileInfo']);
        Route::get('/our/teachers', [StudentRegistration::class, 'GetOurTeachers']);
        Route::get('/single/teacher/{id}', [StudentRegistration::class, 'GetSingleTeacher']);
        Route::get('/getSingleTeacher/{id}', [StudentRegistration::class, 'SingleTeacher']);
        Route::get('/teacher/details/{id}', [StudentRegistration::class, 'TeacherDetails']);
        Route::get('/freelance/single/teacher/{id}', [StudentRegistration::class, 'GetFreelanceSingleTeacher']);
        Route::get('/message/contacts', [StudentRegistration::class, 'GetMessageContacts']);
        Route::get('/other/teachers', [StudentRegistration::class, 'GetFreelanceTeachers']);
        Route::get('/conversations/{teacherId}', [StudentRegistration::class, 'GetConversations'])->where('teacherId', '[0-9]+');;
        Route::post('/message', [StudentRegistration::class, 'sendMessage']);
        Route::post('/markMessageRead', [StudentRegistration::class, 'markMessageRead']);
        Route::post('/addToFavorite', [StudentRegistration::class, 'addToFavorite']);
        Route::post('/removeFromFavorite', [StudentRegistration::class, 'removeFromFavorite']);
        Route::get('/create/ad', function () {
            return view('student.ad');
        });
        
        // Ads
        Route::get('/ad/payment', function () {
            return view('student.adpayment');
        })->name('ad.payment');
        Route::get('/SingleAdPayment', function () {
            return view('student.singleadpayment');
        })->name('singlead.payment');
        Route::post('/create/ad', [StudentRegistration::class, 'AdSave']);
        Route::post('/publish/ad', [StudentRegistration::class, 'PublishAd']);
        Route::post('/EditAd', [StudentRegistration::class, 'EditAd']);
        Route::post('/deleteAd', [StudentRegistration::class, 'deleteAd']);
        Route::get('/ads', [StudentRegistration::class, 'GetAds']);
        // ads

        // paid lesson
        Route::post('/buyHours', [StudentRegistration::class, 'buyHours']);
        // Route::get('/paypaidlesson', function(){
        //     return view('student.paypaidlesson');
        // })->name('paypaidlesson');
        
            
        Route::get('/single/teacher/messages/{teacherId}', function () {
            return view('student.singlemessages');
        });
        Route::get('/getUnreadMessages', [StudentRegistration::class, 'getUnreadMessages']);
        Route::get('/getFavorites', [StudentRegistration::class, 'getFavorites']);
        Route::get('/getFavoriteTeacherIds', [StudentRegistration::class, 'getFavoriteTeacherIds']);
        Route::get('/getAllStudentFavorites', [StudentRegistration::class, 'getAllStudentFavorites']);

        
        Route::get('/getTeacherDetails/{teacherId}', [PaidLessonController::class,'getTeacherDetails']);
        Route::get('/schedule/paid/lesson/{teacherId}', function(){
            return view('student.paidlesson.schedulepaidlesson');
        });
        Route::get('getThisTeacherLessonDetails/{teacherId}',[PaidLessonController::class,'getThisTeacherLessonDetails']);
        Route::get('getHours',[PaidLessonController::class,'getHours']);
        Route::get('/getAllBookedPaidLessons',[PaidLessonController::class, 'getAllBookedPaidLessons']);
        Route::get('/paidlesson/payment/info/{teacherId}',[PaidLessonController::class,'PaidLessonPaymentDetails']);
        Route::post('/paidlesson/insert/payment/details/',[PaidLessonController::class, 'insertPaidPaymentDetails']);
        Route::get('/book/paid/lesson/{teacherId}',[PaidLessonController::class,'buyHours']);
        Route::post('/paidLessonDetails', [PaidLessonController::class, 'paidLessonDetails']);
        Route::get('/payforhours',function(){
            return view('student.payforhours');
        });
        Route::get('/paidlesson/booking/payment/summary/{teacherId}',function(){
            return view('student.demopaymentsummary');
        });

        // Route::get('/lesson/book/{teacherId}', [StudentRegistration::class, 'BookLesson']);
        Route::post('/trial/lesson/confirmation', [StudentRegistration::class, 'TrialLessonConfirmation']);
        Route::get('teacher/demo/lessons/{teacherId}',[StudentRegistration::class,'getStudentTeacherDemoLesson']);
        Route::get('/book/demo/payment/{teacherId}',[StudentRegistration::class,'DemoPayment']);
        Route::get('/cancel/book/demo/lesson/{teacherId}',[StudentRegistration::class,'CancelDemoBooking']);
        Route::get('/incomplete/demo/lessons',[StudentRegistration::class,'incompleteDemoBooking']);
        Route::get('/incomplete/demo/booking',function(){
            return view('student.incompletebooking');
        });
        Route::get('/all/booked/lessons',function(){
            return view('student.allbookedlessons');
        });
        Route::get('/view/demo/lesson{lessonId}',function(){
            return view('student.singledemolesson');
        });
        Route::get('/getSingleDemoLessonDetails{lessonId}',[StudentRegistration::class,'getSingleDemoLessonDetails']);
        Route::get('/getAllBookedDemoLessons',[StudentRegistration::class, 'getAllBookedDemoLessons']);
        Route::get('/demo/booking/payment/summary/{teacherId}',function(){
            return view('student.demopaymentsummary');
        });
        
        Route::get('/demo/payment/info/{teacherId}',[StudentRegistration::class,'DemoPaymentDetails']);
        Route::post('insert/payment/details',[StudentRegistration::class, 'insertDemoPaymentDetails']);
        Route::get('/book/demo/lesson/{teacherId}', function () {
            return view('student.bookdemo');
        });
        Route::get('/freelance/teachers', function () {
            return view('student.freelanceteachers');
        });

        Route::post('/getTeachersByPrice', [StudentRegistration::class, 'getTeachersByPrice']);
        Route::post('/getTeachersByLanguage', [StudentRegistration::class, 'getTeachersByLanguage']);
        Route::post('/getTeachersByCountry', [StudentRegistration::class, 'getTeachersByCountry']);
        Route::post('/getTeachersByName', [StudentRegistration::class, 'getTeachersByName']);
        Route::get('/getAllTrialContactTeachers', [StudentRegistration::class, 'getAllTrialContactTeachers']);

        Route::get('/messages', function () {
            return view('student.message');
        });
        Route::get('/message', function () {
            return view('student.message');
        });
        Route::get('/teachers', function () {
            return view('student.teachers');
        });
        Route::get('/favorite', function () {
            return view('student.favorite');
        });
        Route::get('/single/favorite/{id}', function () {
            return view('student.singlefavorite');
        });
        Route::get('/ad/management', function () {
            return view('student.adsmanagement');
        });
        Route::get('/getSingleAd{id}', [StudentRegistration::class, 'getSingleAd']);
        Route::get('/SingleAdPayment{id}', [StudentRegistration::class, 'SingleAdPayment']);
        Route::get('/single/ad/{id}', function () {
            return view('student.singlead');
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
        Route::get('/logout', [TeachersRegistration::class, 'logout'])->name('logout');

        // get teacher demoDetails
        Route::get('getTeacherDetails', [TeachersRegistration::class,'getTeacherDetails']);
        Route::get('/registration/form',function(){
            return view('teacher.register.registrationform');
        });

        // end of teacher details

        // Registration Form
        Route::post('/saveProfileImage', [TeachersRegistration::class, 'saveProfileImage']);
        Route::post('/deleteTeacherProfilePicture', [TeachersRegistration::class, 'deleteTeacherProfilePicture']);
        Route::post('/saveTeacherDescription', [TeachersRegistration::class, 'saveTeacherDescription']);
        Route::post('/saveTeacherQualification', [TeachersRegistration::class, 'saveTeacherQualification']);
        Route::post('/updateTeachingCertificate', [TeachersRegistration::class, 'updateTeachingCertificate']);
        Route::post('/updateLangCertificate', [TeachersRegistration::class, 'updateLangCertificate']);
        Route::post('/uploadIntroVideo', [TeachersRegistration::class, 'uploadIntroVideo']);
        Route::post('/saveTeacherAvailability', [TeachersRegistration::class, 'saveTeacherAvailability']);
        // Registration form

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
Route::get('/zoom',[StudentRegistration::class, 'zoom']);

// // socialite for teachers
// Route::get('facebook/auth/redirect', function () {
//     return Socialite::driver('facebook')->redirect();
// })->name('teacher.facebook.login');
// Route::get('facebook/auth/callback', [TeacherSocialiteLogin::class, 'teacherFacebook']);


// Route::get('google/auth/redirect', function () {
//     return Socialite::driver('google')->redirect();
// })->name('teacher.google.login');
// Route::get('google/auth/callback', [TeacherSocialiteLogin::class, 'teacherGoogle']);

Route::get('/netflix', function () {
    return view('hakan');
});


Auth::routes();
