<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Polyclinic;
use App\Models\Doctor;
use App\Models\Schedule;

class AppointmentController extends Controller
{
    public function create()
    {
        $polyclinics = Polyclinic::all();
        $doctors = Doctor::all();
        $schedules = Schedule::all();

        return view('patients.register', compact('polyclinics', 'doctors', 'schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_name' => 'required',
            'poly_name' => 'required|string',
            'doctor_name' => 'required|string',
            'schedule' => 'required',
            'medic_record' => 'required'
        ]);

        Appointment::create([
            'patient_name' => $request->patient_name,
            'poly_name' => $request->poly_name,
            'doctor_name' => $request->doctor_name,
            'schedule' => $request->schedule,
            'schedule' => $request->medic_record
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}
