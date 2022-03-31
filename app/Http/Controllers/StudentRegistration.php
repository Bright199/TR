<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Student;
use App\Models\StudentAd;
use App\Models\StudentContact;
use App\Models\StudentDemoPaymentDetail;
use App\Models\StudentFavorite;
use App\Models\Teacher;
use App\Models\TrialLessonBooking;
use Carbon\Carbon;
use DateTimeZone;
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


    public function TrialLessonConfirmation(Request $request)
    {
        $trialConfirmation = TrialLessonBooking::create([
            'teacher_id' => $request->teacherId,
            'student_id' => Auth::guard('student')->id(),
            'date' => date('Y-m-d', strtotime($request->date)),
            'timeslot' => $request->timeslot
        ]);
    }
    public function DemoPaymentDetails($teacherId)
    {
        $demoDetails = StudentDemoPaymentDetail::where('teacher_id',$teacherId)
        ->where('student_id', Auth::guard('student')->id())->first();
        return response()->json($demoDetails);
    }
    public function insertDemoPaymentDetails(Request $request)
    {
        $paymentDetails = StudentDemoPaymentDetail::create([
            'teacher_id' => $request->teacherId,
            'student_id' => Auth::guard('student')->id(),
            'payer_name' => $request->orderData['payer']['name']['given_name'],
            'payer_surname' => $request->orderData['payer']['name']['surname'],
            'email_address' => $request->orderData['payer']['email_address'],
            'currency_code' => $request->orderData['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'],
            'amount' => $request->orderData['purchase_units'][0]['payments']['captures'][0]['amount']['value'],
            'payer_id' => $request->orderData['id'],
        ]);
        if ($paymentDetails) {
            TrialLessonBooking::where('teacher_id', $request->teacherId)
            ->where('student_id', Auth::guard('student')->id())->update(['booked' => 1]);
        }
        // return response()->json($paymentDetails);
    }
    public function CancelDemoBooking($teacherId)
    {
        $trialConfirmation = TrialLessonBooking::where('teacher_id', $teacherId)
            ->where('student_id', Auth::guard('student')->id())->where('booked', 0)->delete();
        return redirect('/student/dashboard');
    }
    public function incompleteDemoBooking()
    {
        $incompleteDemoBooking = TrialLessonBooking::where('student_id', Auth::guard('student')->id())->where('booked', 0)->pluck('teacher_id');
        $teachers = Teacher::whereIn('id', $incompleteDemoBooking->toArray())->get();
        return response()->json($teachers);
    }
    public function getAllBookedDemoLessons()
    {
        $bookedDemoLessons = TrialLessonBooking::where('student_id', Auth::guard('student')->id())->where('booked', 1)->get();
        return response()->json($bookedDemoLessons);
    }


    public function getStudentTeacherDemoLesson($teacherId)
    {
        $trialLessons = TrialLessonBooking::where('teacher_id', $teacherId)->where('student_id', Auth::guard('student')->id())->first();
        return response()->json($trialLessons);
    }
    public function DemoPayment($teacherId)
    {
        $teacherDetails = Teacher::find($teacherId);
        $trialDetails = TrialLessonBooking::where('student_id', Auth::guard('student')->id())->where('teacher_id', $teacherId)->get();
        return view('student.demopayment')
            ->with('teacherDetails', $teacherDetails)
            ->with('trialLessonDetails', $trialDetails);
    }
    // public function BookLessonPayment($teacherId)
    // {
    //     $teacherDetails = Teacher::find($teacherId);
    //     return view('student.bookdemopayment')
    //     ->with('teacherId',$teacherDetails->id);
    // }
    public function sendMessage(Request $request)
    {
        // return response()->json($request->teacherId);
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
        if ($contact === null) {

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
    }
    public function getUnreadMessages()
    {
        $studentId = Auth::guard('student')->id();
        $unreadmessage = Message::where('to', $studentId)
            ->where('is_read', 0)
            ->get();
        return response()->json($unreadmessage);
    }

    public function markMessageRead(Request $request)
    {
        Message::where('to', Auth::guard('student')->id())
        ->where('from', $request->teacherId)
            ->update(['is_read' => 1]);
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
        
        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = Message::select(\DB::raw('`from` as teacher_id, count(`from`) as unread_count'))
            ->where('to', Auth::guard('student')->id())
            ->where('is_read', false)
            ->groupBy('from')//[['teacher_id' => 2, 'unread_count'=>2]]
            ->get();
        $lastMessage = Message::where('to', Auth::guard('student')->id())
            ->orWhere('from', Auth::guard('student')->id())
            ->orderBy('id', 'desc')
            ->get();

             // add an unread key to each contact with the count of unread messages
        $studentContacts = $studentContacts->map(function($contact) use ($unreadIds, $lastMessage) {
            $contactUnread = $unreadIds->where('teacher_id', $contact->teacher_id)->first();
            $exchangedMessage = $lastMessage->first();

            $contact->unread = $contactUnread ? $contactUnread->unread_count : 0;
            $contact->message = $exchangedMessage ? $exchangedMessage->message : '';
            $contact->message_date = $exchangedMessage ? $exchangedMessage->created_at : '';

            return $contact;
        });
        return response()->json($studentContacts);
    }

    // public function GetSingleTeacher($id)
    // {
    //     $teacher = Teacher::find($id);

    //     return view('student.singleteacher')
    //         ->with('teacherName', $teacher->name)
    //         ->with('teacherDescription', $teacher->description)
    //         ->with('teacherFirstLang', $teacher->first_language)
    //         ->with('teacherFirstLangProf', $teacher->first_language_proficiency)
    //         ->with('teacherSecondLang', $teacher->second_language)
    //         ->with('teacherSecondLangProf', $teacher->second_language_proficiency)
    //         ->with('isOurTeacher', $teacher->our_tearcher)
    //         ->with('teacherHourlyPay', $teacher->hourly_pay)
    //         ->with('teacherJoinedAt', $teacher->created_at)
    //         ->with('teacherId', $teacher->id)
    //         ->with('teacherNationality', $teacher->nationality);
    // }

    public function GetSingleTeacher()
    {
        return view('student.ourteacher');
    }

    public function TeacherDetails($id)
    {
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

    public function getFavorites()
    {
        $favoriteTeachers = StudentFavorite::where('student_id', Auth::guard('student')->id())->get();
        return response()->json($favoriteTeachers);
    }
    public function getAllStudentFavorites()
    {
        $teacherIds = StudentFavorite::where('student_id', Auth::guard('student')->id())->pluck('teacher_id');
        $teacherIds->toArray();
        $teacherDetails = Teacher::whereIn('id', $teacherIds)->paginate(10);
        return response()->json($teacherDetails);
    }

    public function getFavoriteTeacherIds()
    {
        $favoriteTeachersIds = StudentFavorite::where('student_id', Auth::guard('student')->id())->pluck('teacher_id');
        return $favoriteTeachersIds->toArray();
    }

    public function addToFavorite(Request $request)
    {
        $teacherDetails = Teacher::find($request->id);
        $teacherCheck = StudentFavorite::where('teacher_id', $request->id)->first();
        // return response()->json($teacherCheck);
        if ($teacherCheck === null) {
            if ($teacherDetails->teacher_image) {
                $favorite = StudentFavorite::create([
                    'teacher_id' => $teacherDetails->id,
                    'teacher_name' => $teacherDetails->name,
                    'teacher_email' => $teacherDetails->email,
                    'teacher_image' => $teacherDetails->teacher_image,
                    'student_id' => Auth::guard('student')->id()
                ]);
                return response()->json($favorite);
            } else {
                $favorite =  StudentFavorite::create([
                    'teacher_id' => $request->id,
                    'teacher_name' => $teacherDetails->name,
                    'teacher_email' => $teacherDetails->email,
                    'student_id' => Auth::guard('student')->id()
                ]);
                return response()->json($favorite);
            }
        }
    }

    public function removeFromFavorite(Request $request)
    {
        StudentFavorite::where('teacher_id', $request->id)->delete();
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
