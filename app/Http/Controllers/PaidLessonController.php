<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class PaidLessonController extends Controller
{
    public function buyHours (Request $request)
    {
         $teacherDetails = Teacher::find($request->teacherId); 
         $lessonDetails = [
             'teacherId'=> $request->teacherId,
             'totalPrice'=> $request->totalPrice,
             'booked_hours'=> $request->booked_hours,
         ];
         return redirect()->route('student.paypaidlesson')
         ->with('teacherDetails',$request->teacherId);      
        //  ->with('lesson',$lessonDetails);      
        // return response()->json($teacherDetails);
    }
}
