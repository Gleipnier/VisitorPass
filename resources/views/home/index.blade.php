@extends('layouts.homeapp')

@section('title', 'Home')

@section('content')

<div class="profile-container">
        <h2>Welcome, {{ Auth::user()->name }}</h2>
        <p>Your profile is complete.</p>
        
        <button id="generate-pass" class="btn btn-primary">Generate Visitor's Pass</button>
        
        <div id="qr-code-container" style="display: none;">

        </div>
    </div>
    
    <script>
    document.getElementById('generate-pass').addEventListener('click', function() {
        fetch('/generate-visitors-pass', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            console.log('QR Code:', data.qrCode);
            if (data.success) {
                document.getElementById('qr-code-container').innerHTML = data.qrCode;
                document.getElementById('qr-code-container').style.display = 'block';
            } else {
                alert('Failed to generate visitor\'s pass');
            }
        });
    });
    </script>
@endsection