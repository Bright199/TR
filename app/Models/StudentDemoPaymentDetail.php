<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDemoPaymentDetail extends Model
{
    use HasFactory;
    public function student(){
        return $this->belongsTo(Student::class);
    }
    protected $fillable = [
        'payer_name',
        'teacher_id',
        'student_id',
        'payer_surname',
        'email_address',
        'currency_code',
        'amount',
        'payer_id'
    ];
}
