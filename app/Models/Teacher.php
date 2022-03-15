<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guards = 'teacher';


    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'facebook_id',
        'teacher_image',
        'description',
        'hourly_pay',
        'currency',
        'first_language',
        'first_language_proficiency',
        'second_language',
        'second_language_proficiency',
        'third_language',
        'third_language_proficiency',
        'nationality',
        'our_teacher',
        'online',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}

