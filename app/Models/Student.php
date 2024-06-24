<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'reg_students';
    protected $fillable = [
        'lastname',
        'firstname',
        'middlename',
        'student_id',
        'course',
        'year_section',
    ];
}
