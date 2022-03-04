<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAd;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class StudentRegistration extends Controller
{
    // public function __construct()
    //     {
    //         $this->middleware('guest:students');
    //     }
    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForm()
    {
        $authUser = Auth::guard('student')->user();
        if (!$authUser) {
            return view('student.login');
        } else {
            return redirect()->route('student.dashboard');
        }
    }

    public function GetOurTeachers()
    {
        $teachers = Teacher::where('our_tearcher',1)->get();
        return response()->json($teachers);
    }

    public function GetSingleTeacher($id)
    {
        $teacher = Teacher::where('our_tearcher',$id)->get();
        return view('student.singleteacher')->with('teacher',$teacher);
        // return response()->json($teachers);
    }

    public function GetAds(){
        $ads = StudentAd::where('student_id',Auth::guard('student')->id())->get();
        return response()->json($ads);
    }
    public function AdSave(Request $request)
    {
        $authUser = Auth::guard('student')->id();
        $StudentAd = StudentAd::create([
            'student_id' => $authUser,
            'title'=> $request->title,
            'description'=> $request->description,
            'language_category'=>$request->language,
            'minimum_budget'=>$request->minamount,
            'maximum_budget' =>$request->maxamount,
            'currency' =>$request->currency,
            'student_gender'=>$request->gender
        ]);
        // if($StudentAd){
        //     return response()->json('Ad created successfully');
        // }else{
        //     return response()->json('Not working');
        // }
    }

    public function CheckProfileInfo()
    {
        $authUser = Student::find(Auth::guard('student')->id());
        return response()->json($authUser);
    }
    public function getAuthUser()
    {
        $authUser = Auth::guard('student')->user();
        return response()->json($authUser);
    }

    public function EditStudentProfile()
    {
        return view('student.editprofile');
    }
    public function EditProfile(Request $request)
    {
        if ($request->hasFile('imageProfile')) {
            $authUser = Student::find(Auth::guard('student')->id());

            $file = $request->file('imageProfile');
            $fileName = time() . $file->getClientOriginalName();
            $path = 'student/images/';
            $file->storeAs($path, $fileName, 'public');

            $authUser->name = $request->username;
            $authUser->user_image = $fileName;
            $authUser->country = $request->country;
            $worked = $authUser->update();
            if ($worked) {
                return response()->json('worked');
            } else {
                return response()->json('failed');
            }
        } else {
            $authUser = Student::find(Auth::guard('student')->id());
            $authUser->name = $request->username;
            $authUser->country = $request->country;
            $worked = $authUser->update();

            if ($worked) {
                return response()->json('worked');
            } else {
                return response()->json('failed');
            }
        }
    }
    // Delete ACcount
    public function DeleteProfile(Request $request)
    {
        $authUser = Student::where('id', Auth::guard('student')->id());
        if ($authUser) {
            $authUser->delete();
        }
    }
    /**
     * Direct the student to the dashboard
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            // Auth::guard('student')->logout();
            return redirect()->intended('/student/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.login');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('student.studentregister');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $newStudent = Student::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        return view('student.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
