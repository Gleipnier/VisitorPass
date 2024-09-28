@extends('layouts.homeapp')

@section('title', 'Home')

@section('content')

<div class="profile-container">
        <h2>Welcome, {{ Auth::user()->name }}</h2>
        
        <button id="generate-pass" class="btn btn-primary">Generate Visitor's Pass</button>
        
        <div id="qr-code-container" style="display: none;">

        </div>

        <button id="download-pdf" class="btn btn-secondary" style="display: none; margin-top: 10px;">Download PDF</button>
    </div>
    
    <script>
document.getElementById('generate-pass').addEventListener('click', function() {
    fetch('/generate-visitors-pass', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('qr-code-container').innerHTML = data.qrCode;
            document.getElementById('qr-code-container').style.display = 'block';
            document.getElementById('download-pdf').style.display = 'block';
            if (data.smsSent) {
                alert('Visitor\'s pass generated and SMS sent successfully!');
            } else {
                alert('Visitor\'s pass generated, but there was an issue sending the SMS.');
            }
        } else {
            alert('Failed to generate visitor\'s pass: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while generating the visitor\'s pass');
    });
});

document.getElementById('download-pdf').addEventListener('click', function() {
    window.location.href = '/download-visitor-pass';
});
    </script>
@endsection