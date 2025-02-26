<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'registrations';

    protected $fillable = [
        'patient_name',
        'polyclinic_id',
        'doctor_id',
        'schedule_id',
        'medic_record_number',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }


    public function polyclinic()
    {
        return $this->belongsTo(Polyclinic::class);
    }


    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function schedules()
    {
        return $this->belongsTo(Schedule::class);
    }
}
