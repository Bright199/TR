<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidLessonPaymentDetail extends Model
{
    public function student(){
        return $this->belongsTo(Student::class);
    }
    use HasFactory;
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
