<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('patients/create');
});

Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store');


Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::get('/appointments/success', [AppointmentController::class, 'successPage'])->name('appointments.successPage');
Route::post('/appointments/store', [AppointmentController::class, 'store'])->name('appointments.store');
