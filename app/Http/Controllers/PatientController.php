<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        try {
            Log::info('Mulai validasi data pasien...');
            $validated = $request->validate([
                'nik' => 'required|unique:patients,nik|min:16|max:16',
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'gender' => 'required|in:Pria,Wanita',
                'birth_date' => 'required|date',
                'phone' => 'required|regex:/^[0-9]{10,15}$/'
            ]);
        
            Log::info('Validasi berhasil, lanjutkan proses penyimpanan.');
        
            $medicalRecordNumber = 'MR-' . now()->format('YmdHis') . rand(100, 999);
            Log::info('Nomor Rekam Medis yang dihasilkan:', ['medical_record_number' => $medicalRecordNumber]);
        
            $patient = Patient::create([
                'medical_record_number' => $medicalRecordNumber,
                'nik' => $request->nik,
                'name' => $request->name,
                'address' => $request->address,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'phone' => $request->phone
            ]);
        
            if (!$patient) {
                Log::error('Gagal menyimpan pasien ke database.');
                return redirect()->back()->with('error', 'Gagal menyimpan data pasien.');
            }
        
            Log::info('Data pasien berhasil disimpan:', $patient->toArray());
        
            Session::put('medical_record_number', $patient->medical_record_number);
        
            if (Session::has('medical_record_number')) {
                Log::info('Sesi berhasil disimpan:', ['session' => Session::get('medical_record_number')]);
            } else {
                Log::error('Gagal menyimpan medical_record_number ke sesi.');
                return redirect()->back()->with('error', 'Terjadi kesalahan dalam penyimpanan sesi.');
            }
        
            return redirect()->route('appointments.create')
                     ->with('success', 'Pendaftaran berhasil! Silakan lanjutkan registrasi.');
        
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat pendaftaran pasien:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }        
}
