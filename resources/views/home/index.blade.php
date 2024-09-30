@extends('layouts.homeapp')

@section('title', 'Home')

@section('content')

<div class="profile-container py-12">
    <div class="profile-content">
        <div class="profile-card">
            <div class="profile-card-body">

            <h2 style="color:white;">Welcome, {{ Auth::user()->name }}</h2>
            <div class="form-group">
            <button id="generate-pass" class="btn-primary">Generate Visitor's Pass</button>
            </div>
            <div id="qr-code-container" style="display: none;">

            </div>
            </div>
        </div>    
    </div>
</div>
    
    <script>
        document.getElementById('generate-pass').addEventListener('click', function() {
        // Redirect to the visit date selection page
        window.location.href = '/select-visit-date';
    });
    </script>
@endsection