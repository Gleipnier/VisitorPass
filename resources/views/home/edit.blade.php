@extends('layouts.homeapp')

@section('content')
<div class="profile-container">
    <h2>Welcome, {{ Auth::user()->name }}</h2>
    <p>Please complete your visitor pass to access all features.</p>
    
    <button id="generate-profile" class="btn btn-primary">Complete Profile</button>
</div>

<script>
    document.getElementById('generate-profile').addEventListener('click', function() {
        alert('Profile completed');
        window.location.href = '{{ route('home') }}';
    }
    );
</script>
@endsection