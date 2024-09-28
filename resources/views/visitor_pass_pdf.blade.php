<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Pass</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { text-align: center; }
        .qr-code { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Visitor Pass</h1>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> {{ $user->phone }}</p>
        <div class="qr-code">
            <img src="data:image/png;base64,{{ $qrCode }}" alt="Visitor Pass QR Code">
        </div>
    </div>
</body>
</html>