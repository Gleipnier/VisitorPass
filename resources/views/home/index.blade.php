@extends('layouts.homeapp')

@section('title', 'Home')

@section('content')

<div class="profile-container">
        <h2>Welcome, {{ Auth::user()->name }}</h2>
        
        <button id="generate-pass" class="btn-primary">Generate Visitor's Pass</button>
        
        <div id="qr-code-container" style="display: none;">

        </div>

</div>
    
    <script>
        document.getElementById('generate-pass').addEventListener('click', function() {
        // Redirect to the visit date selection page
        window.location.href = '/select-visit-date';
    });
    </script>
@endsection