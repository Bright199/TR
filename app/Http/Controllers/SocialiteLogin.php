<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteLogin extends Controller
{
    public function google(Request $request)
    {
        $urlData = $request->session()->all();
        if (isset($urlData['_previous'])) {
            $url = $urlData['_previous']['url'];
            if ($url === 'http://localhost:8000/google/auth/redirect?student=studentGoogle' || $url === 'http://127.0.0.1:8000/google/auth/redirect?student=studentGoogle') {

                try {
                    $googleUser = Socialite::driver('google')->stateless()->user();
                    $user = Student::where('google_id', $googleUser->getId())->first();

                    if ($user !== null) {
                        Auth::guard('student')->login($user);
                        Student::where('id', Auth::guard('student')->id())->update(['online' => 0]);
                        return redirect('/student/dashboard/');
                    } else {
                        $emailCheck = Student::where('email', $googleUser->getEmail())->first();
                        if ($emailCheck === null) {
                            $user = Student::create([
                                'name' => $googleUser->getName(),
                                'email' => $googleUser->getEmail(),
                                'google_id' => $googleUser->getId(),
                                'password' => Hash::make($googleUser->getName() . '@' . $googleUser->getId())
                            ]);
                            Auth::guard('student')->login($user);
                            Student::where('id', Auth::guard('student')->id())->update(['online' => 0]);
                            return redirect('/student/dashboard/');
                        } else {
                            return redirect('/student/login')->with('oath', 'Email is already taken. Login instead');
                        }
                    }
                } catch (\Throwable $th) {
                    return  $th;
                }
            } else if ($url === 'http://localhost:8000/google/auth/redirect?student=teacherGoogle' || $url === 'http://127.0.0.1:8000/google/auth/redirect?student=teacherGoogle') {
                try {
                    $googleUser = Socialite::driver('google')->stateless()->user();
                    $user = Teacher::where('google_id', $googleUser->getId())->first();

                    if ($user !== null) {
                        Auth::guard('teacher')->login($user);
                        Teacher::where('id', Auth::guard('teacher')->id())->update(['online' => 1]);
                        return redirect('/teacher/dashboard/');
                    } else {
                        $emailCheck = Teacher::where('email', $googleUser->getEmail())->first();
                        if ($emailCheck === null) {
                            $user = Teacher::create([
                                'name' => $googleUser->getName(),
                                'email' => $googleUser->getEmail(),
                                'google_id' => $googleUser->getId(),
                                'password' => Hash::make($googleUser->getName() . '@' . $googleUser->getId())
                            ]);
                            Auth::guard('teacher')->login($user);
                            Teacher::where('id', Auth::guard('teacher')->id())->update(['online' => 1]);
                            return redirect('/teacher/dashboard/');
                        } else {
                            return redirect('/teacher/login')->with('oath', 'Email is already use. Login instead');
                        }
                    }
                } catch (\Throwable $th) {
                    return  $th;
                }
            } else {

                return redirect('/student/login')->with('oath', 'We encountered a problem. Try again or manually login');
            }
        } else {
            return redirect()->back();
        }
    }
    public function facebook(Request $request)
    {

        $urlData = $request->session()->all();

        if (isset($urlData['_previous'])) {
            $url = $urlData['_previous']['url'];
            if ($url === 'http://localhost:8000/facebook/auth/redirect?student=studentFacebook' || $url === 'http://127.0.0.1:8000/facebook/auth/redirect?student=studentFacebook') {
                try {
                    $googleUser = Socialite::driver('facebook')->stateless()->user();
                    $user = Student::where('facebook_id', $googleUser->getId())->first();

                    if ($user !== null) {
                        Auth::guard('student')->login($user);
                        Student::where('id', Auth::guard('student')->id())->update(['online' => 0]);
                        return redirect('/student/dashboard/');
                    } else {
                        $user = Student::create([
                            'name' => $googleUser->getName(),
                            'email' => $googleUser->getEmail(),
                            'facebook_id' => $googleUser->getId(),
                            'password' => Hash::make($googleUser->getName() . '@' . $googleUser->getId())
                        ]);
                        Auth::guard('student')->login($user);
                        Student::where('id', Auth::guard('student')->id())->update(['online' => 0]);
                        return redirect('/student/dashboard/');
                    }
                } catch (\Throwable $th) {
                    $th;
                }
            } else if ($url === 'http://localhost:8000/facebook/auth/redirect?student=teacherFacebook' || $url === 'http://127.0.0.1:8000/facebook/auth/redirect?student=teacherFacebook') {
                try {
                    $googleUser = Socialite::driver('facebook')->stateless()->user();
                    $user = Teacher::where('facebook_id', $googleUser->getId())->first();

                    if ($user !== null) {
                        Auth::guard('teacher')->login($user);
                        Teacher::where('id', Auth::guard('teacher')->id())->update(['online' => 1]);
                        return redirect('/teacher/dashboard/');
                    } else {
                        $user = Teacher::create([
                            'name' => $googleUser->getName(),
                            'email' => $googleUser->getEmail(),
                            'facebook_id' => $googleUser->getId(),
                            'password' => Hash::make($googleUser->getName() . '@' . $googleUser->getId())
                        ]);
                        Auth::guard('teacher')->login($user);
                        Teacher::where('id', Auth::guard('teacher')->id())->update(['online' => 1]);
                        return redirect('/teacher/dashboard/');
                    }
                } catch (\Throwable $th) {
                    $th;
                }
            } else {
                return redirect('/student/login')->with('oath', 'We encountered a problem. Try again or manually login');
            }
        } else {
            return redirect()->back();
        }
    }
}
