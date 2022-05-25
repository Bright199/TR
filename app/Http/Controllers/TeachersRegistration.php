<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeachersRegistration extends Controller
{

    public function getTeacherDetails()
    {
        $teacherDetails = Teacher::find(Auth::guard('teacher')->id());
        return response()->json($teacherDetails);
    }

    public function saveProfileImage(Request $request)
    {
        if ($request->hasFile('profileImage')) {
            $authUser = Teacher::find(Auth::guard('teacher')->id());

            $file = $request->file('profileImage');
            $fileName = time() . $file->getClientOriginalName();
            $path = 'teacher/images/';
            $file->storeAs($path, $fileName, 'public');

            $authUser->teacher_image = $fileName;
            $worked = $authUser->update();
            if ($worked) {
                return response()->json('worked');
            } else {
                return response()->json('failed');
            }
        }
    }

    public function deleteTeacherProfilePicture()
    {
        Teacher::where('id', Auth::guard('teacher')->id())->update(['teacher_image' => null]);
    }

    public function saveTeacherDescription(Request $request)
    {

        switch ($request->extra_language) {
            case ('Two'):
                $teacherDescription = $request->validate([
                    'nationality' => ['required', 'string'],
                    'teacher_name' => ['required', 'string'],
                    'first_language' => ['required', 'string'],
                    'first_language_proficiency' => ['required', 'string'],
                    'second_language' => ['required', 'string'],
                    'second_language_proficiency' => ['required', 'string'],
                    'third_language' => ['required', 'string'],
                    'third_language_proficiency' => ['required', 'string'],
                    'personal_description' => ['required', 'string', 'min:100', 'max:1000'],
                    'hourly_pay' => ['required', 'numeric', 'gt:3', 'lt:250']
                ]);

                $updateTeacherDetails = Teacher::where('id', Auth::guard('teacher')->id())
                    ->update([
                        'nationality' => $request->nationality,
                        'name' => $request->teacher_name,
                        'nationality_flag' => $request->flag,
                        'first_language' => $request->first_language,
                        'first_language_proficiency' => $request->first_language_proficiency,
                        'second_language' => $request->second_language,
                        'second_language_proficiency' => $request->second_language_proficiency,
                        'third_language' => $request->third_language,
                        'third_language_proficiency' => $request->third_language_proficiency,
                        'description' => $request->personal_description,
                        'hourly_pay' => $request->hourly_pay,
                    ]);

                break;
            case ('One'):
                $teacherDescription = $request->validate([
                    'nationality' => ['required', 'string'],
                    'teacher_name' => ['required', 'string'],
                    'first_language' => ['required', 'string'],
                    'first_language_proficiency' => ['required', 'string'],
                    'second_language' => ['required', 'string'],
                    'second_language_proficiency' => ['required', 'string'],
                    'personal_description' => ['required', 'string', 'min:100', 'max:1000'],
                    'hourly_pay' => ['required', 'numeric', 'gt:3', 'lt:250']
                ]);

                $updateTeacherDetails = Teacher::where('id', Auth::guard('teacher')->id())
                    ->update([
                        'nationality' => $request->nationality,
                        'nationality_flag' => $request->flag,
                        'name' => $request->teacher_name,
                        'first_language' => $request->first_language,
                        'first_language_proficiency' => $request->first_language_proficiency,
                        'second_language' => $request->second_language,
                        'second_language_proficiency' => $request->second_language_proficiency,
                        'description' => $request->personal_description,
                        'hourly_pay' => $request->hourly_pay,
                    ]);

                break;
            case (''):
                $teacherDescription = $request->validate([
                    'nationality' => ['required', 'string'],
                    'teacher_name' => ['required', 'string'],
                    'first_language' => ['required', 'string'],
                    'first_language_proficiency' => ['required', 'string'],
                    'personal_description' => ['required', 'string', 'min:100', 'max:1000'],
                    'hourly_pay' => ['required', 'numeric', 'gt:3', 'lt:250']
                ]);
                $updateTeacherDetails = Teacher::where('id', Auth::guard('teacher')->id())
                    ->update([
                        'nationality' => $request->nationality,
                        'nationality_flag' => $request->flag,
                        'name' => $request->teacher_name,
                        'first_language' => $request->first_language,
                        'first_language_proficiency' => $request->first_language_proficiency,
                        'description' => $request->personal_description,
                        'hourly_pay' => $request->hourly_pay,
                    ]);

                break;
        }
    }





    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:teachers',
            'password' => 'required|string|min:6|confirmed',
        ]);
        Teacher::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        return view('teacher.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('teacher')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('teacher.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect()->route('teacher.login');
    }
}
