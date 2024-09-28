<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Holiday;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VisitorPassController extends Controller
{
    public function generate(Request $request)
    {

        // Check if today is Sunday
        $today = Carbon::now();

        if ($today->isSunday()) {
             return response()->json([
                'success' => false,
                'message' => 'Visitor passes cannot be generated on Sundays.',
            ]);
            }


        // Checking if its holiday
        $today = now()->toDateString();
    
        $holiday = Holiday::where('date', $today)->first();
        
        if ($holiday) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor passes are not available on holidays: ' . $holiday->name,
            ]);
        }


        $user = $request->user();
       
        // Generate QR code
        $qrCode = (string) QrCode::format('svg')->size(300)->generate(json_encode([
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
        ]));

        
       
        // Send SMS
        $this->sendSMS($user->phone, 'Your visitor pass has been generated.');
       
        return response()->json([
            'success' => true,
            'qrCode' => $qrCode,
        ]);
    }
   
    private function sendSMS($to, $message)
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $from = env('TWILIO_PHONE');

            // Prepend country code +91 for Indian numbers if not already included
        if (substr($to, 0, 1) !== '+') {
        $to = '+91' . ltrim($to, '0');  // Remove leading zero if present
        }
       
        $client = new Client($sid, $token);
       
        try {
            $client->messages->create($to, [
                'from' => $from,
                'body' => $message,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send SMS: ' . $e->getMessage());
        }
    }
}