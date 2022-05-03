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
    
    public function deleteTeacherProfilePicture(){
        Teacher::where('id', Auth::guard('teacher')->id())->update(['teacher_image'=>null]);
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

    public function login (Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::guard('teacher')->attempt($credentials)){
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