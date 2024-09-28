<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Ensure the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the user's profile is incomplete
            if (!$this->hasCompletedProfile($user)) {
                // Redirect to profile completion page if the profile is incomplete
                return redirect()->route('home.defaultprofile');
            }
        }

        // If profile is complete, proceed with the request
        return $next($request);
    }

    /**
     * Determine if the user's profile is completed.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    private function hasCompletedProfile($user)
    {
        // Check if the user has filled necessary fields (add/remove fields as needed)
        return $user->name && $user->email && $user->phone_number;
    }
}
