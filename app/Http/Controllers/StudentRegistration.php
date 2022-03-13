<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Student;
use App\Models\StudentAd;
use App\Models\StudentContact;
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

    public function sendMessage(Request $request)
    {
        $teacherDetails = Teacher::find($request->teacherId);
        $studentDetails = Student::find(Auth::guard('student')->id());

        $message = Message::create([
            'to' => $request->teacherId,
            'from' => Auth::guard('student')->id(),
            'message' => $request->message,
            'teacher_email' => $teacherDetails->email,
            'teacher_name' => $teacherDetails->name,
            'student_name' => $studentDetails->name,
        ]);

        $contact = StudentContact::where('teacher_id', $request->teacherId)->first();
        if ($contact == null) {

            if ($teacherDetails->teacher_image) {
                StudentContact::create([
                    'teacher_name' => $teacherDetails->name,
                    'teacher_email' => $teacherDetails->email,
                    'student_name' => $studentDetails->name,
                    'student_email' => $studentDetails->email,
                    'teacher_image' => $teacherDetails->teacher_image,
                    'student_id' => Auth::guard('student')->id(),
                    'teacher_id' => $request->teacherId
                ]);
            } else {
                StudentContact::create([
                    'teacher_name' => $teacherDetails->name,
                    'teacher_email' => $teacherDetails->email,
                    'student_name' => $studentDetails->name,
                    'student_email' => $studentDetails->email,
                    'student_id' => Auth::guard('student')->id(),
                    'teacher_id' => $request->teacherId
                ]);
            }
        }

        return redirect('/student/messages');
    }
    public function getUnreadMessages()
    {
        $studentId = Auth::guard('student')->id();
        $unreadmessage = Message::where('to', $studentId)
        ->where('is_read', 0)
        ->get();
        return response()->json($unreadmessage);
    }

    public function GetOurTeachers()
    {
        $teachers = Teacher::where('our_tearcher', 1)
            ->where('id', '!=', Auth::guard('student')->id())
            ->orderBy('id', 'desc')->paginate(2);
        return response()->json($teachers);
    }
    public function GetFreelanceTeachers()
    {
        $teachers = Teacher::where('our_tearcher', 0)
            ->where('id', '!=', Auth::guard('student')->id())
            ->orderBy('id', 'desc')->paginate(2);
        return response()->json($teachers);
        // return view('student.freelanceteachers');
    }

    public function GetConversations($teacherId)
    {
        $studentId = Auth::guard('student')->id();
        $teacher = $teacherId;
        $message = Message::where(function ($query) use ($studentId, $teacher) {
            $query->where('to', $studentId)->where('from', $teacher);
        })->orWhere(function ($query) use ($studentId, $teacher) {
            $query->where('to', $teacher)->where('from', $studentId);
        })->get();
        return response()->json($message);
    }
    public function getReceivedMessages()
    {
        $studentId = Auth::guard('student')->id();
        $message = Message::where('to', $studentId)->get();
        return response()->json($message);
    }

    public function GetMessageContacts()
    {
        $studentContacts = StudentContact::where('student_id', Auth::guard('student')->id())->orderBy('id', 'desc')->get();
        return response()->json($studentContacts);
    }

    public function GetSingleTeacher($id)
    {
        $teacher = Teacher::find($id);

        return view('student.singleteacher')
            ->with('teacherName', $teacher->name)
            ->with('teacherDescription', $teacher->description)
            ->with('teacherFirstLang', $teacher->first_language)
            ->with('teacherFirstLangProf', $teacher->first_language_proficiency)
            ->with('teacherSecondLang', $teacher->second_language)
            ->with('teacherSecondLangProf', $teacher->second_language_proficiency)
            ->with('isOurTeacher', $teacher->our_tearcher)
            ->with('teacherHourlyPay', $teacher->hourly_pay)
            ->with('teacherJoinedAt', $teacher->created_at)
            ->with('teacherId', $teacher->id)
            ->with('teacherNationality', $teacher->nationality);
        // return response()->json($teachers);
    }

    public function TeacherDetails($id){
        $teacher = Teacher::find($id);
        return response()->json($teacher);
    }
    public function GetFreelanceSingleTeacher($id)
    {
        $teacher = Teacher::find($id);

        return view('student.freelancesingleteacher')
            ->with('teacherName', $teacher->name)
            ->with('teacherDescription', $teacher->description)
            ->with('teacherFirstLang', $teacher->first_language)
            ->with('teacherFirstLangProf', $teacher->first_language_proficiency)
            ->with('teacherSecondLang', $teacher->second_language)
            ->with('teacherSecondLangProf', $teacher->second_language_proficiency)
            ->with('isOurTeacher', $teacher->our_tearcher)
            ->with('teacherHourlyPay', $teacher->hourly_pay)
            ->with('teacherJoinedAt', $teacher->created_at)
            ->with('teacherId', $teacher->id)
            ->with('teacherNationality', $teacher->nationality);
        // return response()->json($teachers);
    }

    public function GetAds()
    {
        $ads = StudentAd::where('student_id', Auth::guard('student')->id())->get();
        return response()->json($ads);
    }
    public function AdSave(Request $request)
    {
        $authUser = Auth::guard('student')->id();
        $StudentAd = StudentAd::create([
            'student_id' => $authUser,
            'title' => $request->title,
            'description' => $request->description,
            'language_category' => $request->language,
            'minimum_budget' => $request->minamount,
            'maximum_budget' => $request->maxamount,
            'currency' => $request->currency,
            'student_gender' => $request->gender
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
