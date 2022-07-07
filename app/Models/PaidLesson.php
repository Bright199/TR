<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidLesson extends Model
{
    use HasFactory;
    public function student(){
        return $this->belongsTo(Student::class);
    }
    protected $fillable = [
        'teacher_id',
        'student_id',
        'teacher_hourly_pay',
        'student_booked_hours',
        'package',
        'paid_amount',
        'teacher_time_slot',
        'student_time_slot',
        'teacher_timezone',
        'student_timezone',
        'teacher_date',
        'student_date',
        'booked', 
        'lessons_completed',
        'remaining_lesson_hours',
        'remaining_amount',
    ];
}
