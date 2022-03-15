<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFavorite extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_name','teacher_email','teacher_image','student_id','teacher_id',];
}
