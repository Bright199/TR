<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class TeacherSocialiteLogin extends Controller
{
    public function teacherGoogle()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = Teacher::where('google_id', $googleUser->getId())->first();

            if ($user) {
                Auth::guard('teacher')->login($user);
                return redirect('/teacher/dashboard/');
            } else {
                $user = Teacher::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make($googleUser->getName() . '@' . $googleUser->getId())
                ]);
            }
            Auth::guard('teacher')->login($user);
            return redirect('/teacher/dashboard/');
        } catch (\Throwable $th) {
            return redirect('/teacher/login');
        }
    }
    public function teacherFacebook()
    {
        try {
            $googleUser = Socialite::driver('facebook')->stateless()->user();
            $user = Teacher::where('facebook_id', $googleUser->getId())->first();

            if ($user) {
                Auth::guard('teacher')->login($user);
                return redirect('/teacher/dashboard/');
            } else {
                $user = Teacher::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'facebook_id' => $googleUser->getId(),
                    'password' => Hash::make($googleUser->getName() . '@' . $googleUser->getId())
                ]);
            }
            Auth::guard('teacher')->login($user);
            return redirect('/teacher/dashboard/');
        } catch (\Throwable $th) {
            return redirect('/teacher/login');
        }
    }
}
