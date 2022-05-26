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
        'registration_completed',
        'account_vissible',
        'account_verified',
        'name',
        'email',
        'password',
        'google_id',
        'facebook_id',
        'teacher_image',
        'description',
        'hourly_pay',
        'currency',
        'intro_video_url',
        'intro_video_verified',
        'first_language',
        'first_language_proficiency',
        'second_language',
        'second_language_proficiency',
        'third_language',
        'third_language_proficiency',
        'nationality',
        'nationality_flag',
        'our_teacher',
        'online',
        'has_verification_badge',
        'has_lang_certificate',
        'lang_certificate_doc',
        'lang_certificate_year',
        'has_teaching_certificate',
        'teaching_certificate_doc',
        'teaching_certificate_year'

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}

