<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    protected $table = 'reg_instructors';
    protected $fillable = [
        'instructor_lastname',
        'instructor_firstname',
        'instructor_middlename',
        'instructor_id',
        'voice_recording',
    ];
    protected $hidden = ['audio_data'];
}
