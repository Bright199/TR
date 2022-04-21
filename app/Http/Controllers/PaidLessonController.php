<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaidLessonController extends Controller
{
    public function buyHours($teacherId)
    {
        $teacherDetails = Teacher::find($teacherId);
        return view('student.bookpaidlesson');
        //  ->with('teacherDetails',$teacherDetails);      
    }

    public function paidLessonDetails(Request $request)
    {
      
        $teacherDetails = Teacher::find($request->teacherId);
        // $request->session()->forget('teacherDetails');
        // session()->flush('teacherDetails',$teacherDetails);
        Session::put('lessonDetails', ['teacherName' => $teacherDetails->name, 'teacherId' => $request->teacherId, 'totalPrice' => $request->totalPrice, 'booked_hours' => $request->booked_hours]);
        return redirect('student/payforhours');
    }
}
