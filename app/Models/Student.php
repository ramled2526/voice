<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'student_lastname',
        'student_firstname',
        'student_middlename',
        'student_id', 
        'course',
        'year_section',
    ];
}
