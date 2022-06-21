<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'week_day',
        'date',
        'slot1',
        'slot2',
        'slot3',
        'slot4',
        'slot5',
        'slot6',
        'slot7',
        'slot8',
        'slot9',
        'slot10',
        'slot11',
        'slot12',
        'slot13',
        'slot14',
        'slot15',
        'slot16',
        'slot17',
        'slot18',
        'slot19',
        'slot20',
        'slot2',
        'slot22',
        'slot23',
        'slot24',
    ];
}
