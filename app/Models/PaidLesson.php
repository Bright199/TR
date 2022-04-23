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
        'time_slot',
        'date',
        'booked', 
        'lessons_completed',
        'remaining_lesson_hours',
        'remaining_amount',
    ];
}
