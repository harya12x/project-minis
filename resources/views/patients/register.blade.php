<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Pasien</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            font-size: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        select, input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        @if (session('error'))
            <div style="background-color: #ffdddd; color: red; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div style="background-color: #ddffdd; color: green; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('warning'))
            <div style="background-color: #fff4cc; color: #856404; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('warning') }}
            </div>
        @endif

        <h1>Form Pendaftaran Pasien</h1>
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <label for="patient_name">Nama Pasien:</label>
            <input type="text" name="patient_name" required>

            <label for="polyclinic_id">Poliklinik:</label>
            <select name="polyclinic_id" required>
                <option value="">Pilih Poliklinik</option>
                @foreach($polyclinics as $polyclinic)
                    <option value="{{ $polyclinic->id }}">{{ $polyclinic->name }}</option>
                @endforeach
            </select>

            <label for="doctor_id">Dokter:</label>
            <select name="doctor_id" required>
                <option value="">Pilih Dokter</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->doctor_id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>

            <label for="schedule_id">Jadwal:</label>
            <select name="schedule_id" required>
                <option value="">Pilih Jadwal</option>
                @foreach($schedules as $schedule)
                    <option value="{{ $schedule->schedule_id }}">{{ $schedule->start_time }} - {{ $schedule->end_time }}</option>
                @endforeach
            </select>

            <label for="medic_record_number">No. Rekam Medis:</label>
            <input type="text" name="medic_record_number" value="{{ $medicalRecordNumber }}" readonly>



            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
