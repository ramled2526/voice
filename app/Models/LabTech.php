<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTech extends Model
{
    use HasFactory;

    protected $table = 'reg_technician';
    protected $fillable = [
        'technician_lastname',
        'technician_firstname',
        'technician_middlename',
        'technician_id',
        'voice_recording',
    ];
    protected $hidden = ['audio_data'];
}
