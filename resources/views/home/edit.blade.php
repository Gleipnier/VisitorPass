@extends('layouts.homeapp')

@section('content')
<div class="profile-container">
    <h2>Welcome, {{ Auth::user()->name }}</h2>
    <p>Please complete your profile to access all features.</p>
    
    <a class="btn btn-primary">Complete Profile</a>
</div>
@endsection