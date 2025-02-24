<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $fillable = [
        'medical_record_number',
        'nik',
        'name',
        'address',
        'gender',
        'birth_date',
        'phone',
    ];

}
