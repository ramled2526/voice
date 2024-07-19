<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $fillable = [
        'student_id',
        'firstname',
        'lastname',
        'middlename',
        'course',
        'year_section',
        'start_time',
        'end_time',
        'appointment_date',
    ];
}
