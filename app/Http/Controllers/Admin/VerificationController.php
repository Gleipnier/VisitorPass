<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Visit;
use App\Models\Exits;
use Carbon\Carbon;

class VerificationController extends Controller
{
    public function verifyPass(Request $request)
    {
        $qrData = json_decode($request->qrData, true);
        
        if (!$qrData || !isset($qrData['id'])) {
            return response()->json(['valid' => false, 'message' => 'Invalid QR code data']);
        }
        
        $user = User::find($qrData['id']);
        
        if (!$user || $user->name !== $qrData['name'] || $user->phone !== $qrData['phone'] || $user->designation !== $qrData['designation']) {
            return response()->json(['valid' => false, 'message' => 'User verification failed']);
        }
        
      // Check for existing visit
      $lastVisit = Visit::where('user_id', $user->id)->where('exit', false)->latest()->first();
       
      if ($lastVisit) {
          // Log exit
          Exits::create([
              'user_id' => $user->id,
              'name' => $user->name,
              'phone' => $user->phone,
              'exit_time' => Carbon::now(),
          ]);
          $lastVisit->update(['exit' => true]);
          $action = 'exit';
      } else {
          // Log new visit
          Visit::create([
              'user_id' => $user->id,
              'name' => $user->name,
              'phone' => $user->phone,
              'entry_time' => Carbon::now(),
          ]);
          $action = 'entry';
      }

        return response()->json([
            'valid' => true,
            'action'=> $action,
            'user' => [
                'name' => $user->name,
                'phone' => $user->phone,
                'designation' => $user->designation,
            ]
        ]);
    }

    
    public function getVisitStats()
    {
        $stats = Visit::selectRaw('DATE(entry_time) as date, COUNT(*) as count')
                      ->groupBy('date')
                      ->orderBy('date', 'desc')
                      ->get();

        return response()->json($stats);
    }
    
}