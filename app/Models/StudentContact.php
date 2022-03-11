<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentContact extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_name','teacher_email','student_name','student_email','teacher_image','teacher_id','student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
