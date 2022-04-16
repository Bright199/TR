<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrialBookingNotification extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id', 
        'teacher_id'
    ];
}
