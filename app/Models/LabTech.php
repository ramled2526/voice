<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTech extends Model
{
    use HasFactory;

    protected $fillable = [
        'lastname',
        'firstname',
        'middlename',
        'labtech-id',
        'voice_data_path',
    ];
}
