<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteLogin extends Controller
{
    public function google(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = Student::where('google_id', $googleUser->getId())->first();

            if ($user) {
                Auth::guard('student')->login($user);
                return redirect('/student/dashboard/');
            } else {
                $user = Student::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make($googleUser->getName() . '@' . $googleUser->getId())
                ]);
            }
            Auth::guard('student')->login($user);
            return redirect('/student/dashboard/');
        } catch (\Throwable $th) {
            return redirect('/student/login');
        }
    }
    public function facebook()
    {
        try {
            $googleUser = Socialite::driver('facebook')->stateless()->user();
            $user = Student::where('facebook_id', $googleUser->getId())->first();

            if ($user) {
                Auth::guard('student')->login($user);
                return redirect('/student/dashboard/');
            } else {
                $user = Student::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'facebook_id' => $googleUser->getId(),
                    'password' => Hash::make($googleUser->getName() . '@' . $googleUser->getId())
                ]);
            }
            Auth::guard('student')->login($user);
            return redirect('/student/dashboard/');
        } catch (\Throwable $th) {
            return redirect('/student/login');
        }
    }
}
