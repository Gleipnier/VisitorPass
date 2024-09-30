@extends('layouts.homeapp')

@section('title', 'Home')
<style>
/* Scoped styles for the profile form */
.profile-container {
    padding-top: 3rem;
    padding-bottom: 3rem;
}

.profile-content {
    max-width: 72rem;
    margin-left: auto;
    margin-right: auto;
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}

.profile-card {
    background-color: #fff;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.profile-card-body {
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.success-message {
    margin-bottom: 1rem;
    padding: 0.75rem 1rem;
    background-color: #d1fae5;
    border: 1px solid #10b981;
    color: #065f46;
    border-radius: 0.375rem;
}

.profile-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    font-size: 1rem;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
}

.form-input {
    padding: 0.5rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    font-size: 1rem;
    color: #1f2937;
    outline: none;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.form-input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
}

.submit-button {
    background-color: #4f46e5;
    color: white;
    font-size: 1rem;
    padding: 0.75rem 1.5rem;
    border-radius: 0.375rem;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.submit-button:hover {
    background-color: #4338ca;
}

.submit-button:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
}

</style>
@section('content')

<div class="profile-container py-12">
        <div class="profile-content">
            <div class="profile-card">
                <div class="profile-card-body">
                    @if (session('success'))
                        <div class="success-message">
                            {{ session('success') }}
                        </div>
                    @endif
    
                    <form method="POST" action="{{ route('user.profile.update') }}" class="profile-form">
                        @csrf
                        @method('PUT')
    
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="form-input">
                        </div>
    
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required class="form-input">
                        </div>
    
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="form-input">
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" required class="form-input">
                        </div>
    
                        <div class="form-group">
                            <button id="update-finished" type="submit" class="submit-button">
                                Update Profile
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection