<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class UserProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile-edit', compact('user'));
    }
    
    public function update(Request $request)
    {
            /** @var \App\Models\User $user */
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'address' => 'required|string|max:255',
    ]);

    $user->update($request->only(['name', 'phone', 'email', 'address']));

    return redirect()->route('user.profile.edit')->with('success', 'Profile updated successfully.');
    }
}
