<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guards = 'student';
    public function studentAd()
    {
        return $this->hasMany(StudentAd::class);
    }
    public function studentContacts()
    {
        return $this->hasMany(StudentContact::class);
    }
    public function paidlesson()
    {
        return $this->hasMany(PaidLesson::class);
    }
    public function paidlessonpayment()
    {
        return $this->hasMany(PaidLessonPaymentDetail::class);
    }
    public function studentdemopayment()
    {
        return $this->hasMany(StudentDemoPaymentDetail::class);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'facebook_id',
        'user_image',
        'country',
        'phone_number',
        'online',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
