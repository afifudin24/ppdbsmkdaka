<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Code - {{ $no_regis }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .qr-container {
            display: inline-block;
            padding: 20px;
            border: 2px solid #333;
            border-radius: 12px;
            background: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .qr-container h3 {
            margin-bottom: 15px;
        }
        .qr-container svg {
            width: 200px;
            height: 200px;
        }
        .btn-download {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            color: #fff;
            background: #28a745;
            border-radius: 6px;
            transition: background 0.3s;
        }
        .btn-download:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="qr-container">
        <h3>QR Code Identitas</h3>
        {!! $qrSvg !!}
        <p><strong>No. Registrasi:</strong> {{ $no_regis }}</p>

        {{-- Tombol Unduh --}}
        <a href="{{ asset('qr_code/' . $no_regis . '.svg') }}" 
           class="btn-download" download>
           Unduh QR Code
        </a>
    </div>
</body>
</html>
