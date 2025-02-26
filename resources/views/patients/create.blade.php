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
            width: 350px;
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
        input, select {
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
        <h1>Form Pendaftaran Pasien</h1>
        
        <form action="{{ route('patients.store') }}" method="POST">
            @csrf
            <label for="nik">NIK:</label>
            <input type="text" name="nik" value="{{ old('nik') }}" required>
            @if ($errors->has('nik'))
                <div style="color: red; font-size: 14px; margin-top: 5px;">
                    {{ $errors->first('nik') }}
                </div>
            @endif


            <label for="name">Nama:</label>
            <input type="text" name="name" required>

            <label for="address">Alamat:</label>
            <input type="text" name="address" required>

            <label for="gender">Jenis Kelamin:</label>
            <select name="gender" required>
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
            </select>

            <label for="birth_date">Tanggal Lahir:</label>
            <input type="date" name="birth_date" required>

            <label for="phone">Telepon:</label>
            <input type="text" name="phone" required>

            <button type="submit">Daftar</button>
        </form>
    </div>
</body>
</html>
