<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentContact extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','teacher_image','teacher_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
