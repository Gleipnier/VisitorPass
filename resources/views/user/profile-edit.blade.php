@extends('layouts.homeapp')

@section('title', 'Home')

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