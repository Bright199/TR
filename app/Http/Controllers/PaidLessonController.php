<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\PaidLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PaidLessonPaymentDetail;
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
        Session::put('lessonDetails', ['youSave'=>$request->you_save,'package' => $request->package, 'teacherName' => $teacherDetails->name, 'teacherId' => $request->teacherId, 'totalPrice' => $request->totalPrice, 'booked_hours' => $request->booked_hours, 'hourly_pay' => $teacherDetails->hourly_pay]);
        return redirect('student/payforhours');
    }

    public function insertPaidPaymentDetails(Request $request)
    {
        $paymentDetails = PaidLessonPaymentDetail::create([
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
            $teacherDetails = Teacher::find($request->teacherId);
            PaidLesson::create([
                'teacher_id'=> $request->teacherId,
                'student_id'=> Auth::guard('student')->id(),
                'teacher_hourly_pay'=> $teacherDetails->hourly_pay,
                'student_booked_hours'=> $request->booked_hours,
                'paid_amount'=> $request->totalPrice,
                'package'=> $request->package,
                'booked'=> 1, 
                'lessons_completed' => 0,
                'remaining_lesson_hours'=> $request->booked_hours,
                'remaining_amount'=> $request->totalPrice,
            ]);
        }
        // return response()->json($paymentDetails);
    }

    public function PaidLessonPaymentDetails ($teacherId)
    {
        $paidlessondetails = PaidLessonPaymentDetail::where('teacher_id', $teacherId)
            ->where('student_id', Auth::guard('student')->id())->orderBy('id', 'desc')->first();
        return response()->json($paidlessondetails);
    }
}
