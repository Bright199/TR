<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrialLessonBooking extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id','student_id','teacher_date','student_date','student_timeslot','teacher_timeslot','booked','lesson_completed', 'teacher_timezone','student_timezone'];
}
