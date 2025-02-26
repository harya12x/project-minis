<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Berhasil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        h2 {
            color: #2ecc71;
        }
        p {
            color: #333;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>✅ Registrasi Berhasil!</h2>
        <p>Selamat, pendaftaran Anda telah berhasil.</p>
        <p>Nomor Rekam Medis Anda: <strong>{{ isset($medicalRecordNumber) ? $medicalRecordNumber : 'Tidak ditemukan' }}</strong></p>
        <p>Silakan lanjutkan ke halaman registrasi kunjungan.</p>
        <a href="{{ route('patients.create') }}" class="btn">Lanjutkan Registrasi</a>
    </div>

</body>
</html>
