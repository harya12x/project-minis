<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function create()
    {
        return view('patients.create');
    }

    public function register()
    {
        return view('patients.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:patients,nik',
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required|in:Pria,Wanita',
            'birth_date' => 'required|date',
            'phone' => 'required'
        ]);

        $medicalRecordNumber = time(); // Generate nomor unik

        Patient::create([
            'medical_record_number' => $medicalRecordNumber,
            'nik' => $request->nik,
            'name' => $request->name,
            'address' => $request->address,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'phone' => $request->phone
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil!');
    }
}
