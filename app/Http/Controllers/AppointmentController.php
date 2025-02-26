<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Polyclinic;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    public function create()
    {
        $polyclinics = Polyclinic::all();
        $doctors = Doctor::all();
        $schedules = Schedule::all();


        $medicalRecordNumber = Session::get('medical_record_number');

        if (!$medicalRecordNumber) {
            return redirect()->route('patients.create')->with('error', 'Silakan masukkan data pasien terlebih dahulu.');
        }

        

        return view('patients.register', compact('polyclinics', 'doctors', 'schedules', 'medicalRecordNumber'));
    }

    public function successPage()
    {
        $medicalRecordNumber = Session::get('medical_record_number');
    
        session()->flash('medical_record_number', $medicalRecordNumber);

        return view('patients.success', compact('medicalRecordNumber'));

    }
    

    public function store(Request $request)
    {
        Log::info('Data request diterima:', $request->all());

    
        $medicRecordNumber = Session::get('medical_record_number');

        if (!$medicRecordNumber) {
            return redirect()->route('patients.create')->with('error', 'Data pasien tidak ditemukan. Silakan isi ulang.');
        }

        $validated = $request->validate([
            'patient_name' => 'required',
            'polyclinic_id' => 'required|exists:polyclinics,id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'schedule_id' => 'required|exists:schedules,schedule_id',
        ]);

        Log::info('Validasi berhasil:', $validated);


        $patient = Patient::where('medical_record_number', $medicRecordNumber)->first();

        if (!$patient) {
            return redirect()->back()->with('error', 'Pasien tidak ditemukan.');
        }

        if (strcasecmp($patient->name, $request->patient_name) !== 0) {
            return redirect()->back()->with('error', 'Nama pasien tidak sesuai dengan No. Rekam Medis.');
        }


        $schedule = Schedule::where('schedule_id', $request->schedule_id)->first();

        if (!$schedule) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
        }

        $current_time = now();
        $start_time = Carbon::parse($schedule->start_time);
        $end_time = Carbon::parse($schedule->end_time);
        $allowed_registration_start = $start_time->subMinutes(31);

        if ($current_time->lessThan($allowed_registration_start)) {
            return redirect()->back()->with('error', 'Pendaftaran belum dibuka.');
        }

        if ($current_time->greaterThan($end_time)) {
            return redirect()->back()->with('error', 'Pendaftaran sudah ditutup.');
        }


        $check_user = Appointment::where('medic_record_number', $medicRecordNumber)->first();

        if ($check_user) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar dan tidak dapat mendaftar lagi.');
        }


        $appointment = Appointment::create([
            'patient_name' => $request->patient_name,
            'polyclinic_id' => $request->polyclinic_id,
            'doctor_id' => $request->doctor_id,
            'schedule_id' => $request->schedule_id,
            'medic_record_number' => $medicRecordNumber
        ]);

        Log::info('Data appointment berhasil disimpan', $appointment->toArray());


        return redirect()->route('appointments.successPage')->with('success', 'Pendaftaran berhasil!');
    }
}
