<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class VerificationController extends Controller
{
    public function verifyPass(Request $request)
    {
        $qrData = json_decode($request->qrData, true);
        
        if (!$qrData || !isset($qrData['id'])) {
            return response()->json(['valid' => false]);
        }
        
        $user = User::find($qrData['id']);
        
        if (!$user || $user->name !== $qrData['name'] || $user->email !== $qrData['email']) {
            return response()->json(['valid' => false]);
        }
        
        return response()->json([
            'valid' => true,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }
}