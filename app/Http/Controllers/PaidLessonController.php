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
    public function getTeacherDetails($teacherId)
    {
        $teacherDetails = Teacher::find($teacherId);
        return response()->json($teacherDetails);
    }
    public function buyHours($teacherId)
    {
        $teacherDetails = Teacher::find($teacherId);
        return view('student.bookpaidlesson');
        //  ->with('teacherDetails',$teacherDetails);      
    }

    public function paidLessonDetails(Request $request)
    {

        $teacherDetails = Teacher::where('id',$request->teacherId)->first();
        if ($teacherDetails === null) {
            return;
        }else{
            Session::forget('lessonDetails');
            Session::put('lessonDetails', [
            'youSave' => $request->you_save, 
            'package' => $request->package, 
            'teacherName' => $teacherDetails->name, 
            'teacherId' => $request->teacherId, 
            'totalPrice' => $request->totalPrice, 
            'booked_hours' => $request->booked_hours, 
            'hourly_pay' => $teacherDetails->hourly_pay]);
            return redirect('student/payforhours');
        }
    }

    public function insertPaidPaymentDetails(Request $request)
    {

        $CheckLessonAvailability = PaidLesson::where('teacher_id', $request->teacherId)
            ->where('student_id', Auth::guard('student')->id())->where('remaining_lesson_hours', '=', 0)->first();

        if ($CheckLessonAvailability === null) {
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
                    'teacher_id' => $request->teacherId,
                    'student_id' => Auth::guard('student')->id(),
                    'teacher_hourly_pay' => $teacherDetails->hourly_pay,
                    'student_booked_hours' => $request->booked_hours,
                    'paid_amount' => $request->totalPrice,
                    'package' => $request->package,
                    'booked' => 1,
                    'lessons_completed' => 0,
                    'remaining_lesson_hours' => $request->booked_hours,
                    'remaining_amount' => $request->totalPrice,
                ]);
            }
        } else {
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
                PaidLesson::where('teacher_id', $request->teacherId)
                    ->where('student_id', Auth::guard('student')->id())
                    ->update([
                        'teacher_hourly_pay' => $teacherDetails->hourly_pay,
                        'student_booked_hours' => $request->booked_hours,
                        'paid_amount' => $request->totalPrice,
                        'package' => $request->package,
                        'booked' => 1,
                        'lessons_completed' => 0,
                        'remaining_lesson_hours' => $request->booked_hours,
                        'remaining_amount' => $request->totalPrice,
                    ]);
            }
        }
    }

    public function getThisTeacherLessonDetails($teacherId)
    {
        $checkTeacherLessonExist = PaidLesson::where('student_id', Auth::guard('student')->id())
            ->where('teacher_id', $teacherId)
            ->where('remaining_lesson_hours', '>', 0)->get();
        return response()->json($checkTeacherLessonExist);
    }
    public function PaidLessonPaymentDetails($teacherId)
    {
        $paidlessondetails = PaidLessonPaymentDetail::where('teacher_id', $teacherId)
            ->where('student_id', Auth::guard('student')->id())->orderBy('id', 'desc')->first();
        return response()->json($paidlessondetails);
    }

    public function getAllBookedPaidLessons()
    {
        $lessonsIds = PaidLesson::where('student_id', Auth::guard('student')->id())->pluck('teacher_id')->toArray();
        $paidlessons = PaidLesson::where('student_id', Auth::guard('student')->id())->get();
        $teachers = Teacher::whereIn('id', $lessonsIds)->get();
        $paidlessons = $paidlessons->map(function ($lesson) use ($teachers) {
            $teacherDetails = $teachers->where('id', $lesson->teacher_id)->first();

            $lesson->teacher_name = $teacherDetails ? $teacherDetails->name : '';
            $lesson->teacher_image = $teacherDetails ? $teacherDetails->teacher_image : '';
            $lesson->teacher_online = $teacherDetails ? $teacherDetails->online : '';
            $lesson->language = $teacherDetails ? $teacherDetails->first_language : '';
            return $lesson;
        });
        return response()->json($paidlessons);
    }

    public function getHours()
    {
        $hours = PaidLesson::where('student_id', Auth::guard('student')->id())->pluck('remaining_lesson_hours')->toArray();
        return response()->json($hours);
    }
}
