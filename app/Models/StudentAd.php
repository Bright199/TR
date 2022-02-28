<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class StudentAd extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $guards = 'student';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


    protected $fillable = [
        'title',
        'description',
        'language_category',
        'minimum_budget',
        'maximum_budget',
        'currency',
        'student_gender',
        'student_id'
    ];

    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];
}
