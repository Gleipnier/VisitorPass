<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\User;
use App\Models\Holiday;
use Twilio\Rest\Client;
use App\Models\VisitorPass;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class VisitorPassController extends Controller
{
    public function showDateSelection()
    {
        return view('visitor_pass_date_selection');
    }

    public function generate(Request $request)
    {
        Log::info('Received request data:', $request->all()); // Add this line

        $request->validate([
            'visit_date' => 'required|date|after_or_equal:today',
        ]);

        $visitDate = Carbon::parse($request->visit_date);

        // Check if selected date is Sunday
        if ($visitDate->isSunday()) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor passes cannot be generated for Sundays.',
            ]);
        }

        // Check if selected date is a holiday
        $holiday = Holiday::where('date', $visitDate->toDateString())->first();
        if ($holiday) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor passes are not available on holidays: ' . $holiday->name,
            ]);
        }

        $user = $request->user();

        // Check if phone_number or any other required field is null
        if (is_null($user->address)) {
            return response()->json([
                'success' => false,
                'message' => 'Please complete your profile to generate visitor\'s pass',
            ], 400);
        }

        // Generate QR code
        $qrCode = (string) QrCode::format('svg')->size(300)->generate(json_encode([
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'address' => $user->address,
            'email' => $user->email,
            'visit_date' => $visitDate->toDateString(),
        ]));


        // Save the pass
        VisitorPass::create([
            'user_id' => Auth::id(),
            'visit_date' => $request->visit_date,
        ]);


        // Send SMS
        $this->sendSMS($user->phone, 'Your visitor pass has been generated for ' . $visitDate->format('Y-m-d') . '.');

        return response()->json([
            'success' => true,
            'qrCode' => $qrCode,
            'message' => 'Pass generated successfully!'
        ]);
    }

    public function downloadPDF(Request $request)
    {
        $user = $request->user();
        $visitDate = $request->input('visit_date');
        Log::info('Visit Date for PDF:', ['visit_date' => $visitDate]);
        $qrCodeData = json_encode([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'visit_date' => $visitDate,
        ]);
        $qrCode = QrCode::size(300)->format('png')->generate($qrCodeData);
        $qrCodeBase64 = base64_encode($qrCode);
        $pdf = Pdf::loadView('visitor_pass_pdf', [
            'user' => $user,
            'qrCode' => $qrCodeBase64,
            'visit_date' => $visitDate,
        ]);
        return $pdf->download('visitor_pass.pdf');
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

    public function getHistory()
    {
        $history = VisitorPass::where('user_id', auth::id())
                              ->orderBy('visit_date', 'desc')
                              ->get(['id', 'visit_date']);

        return response()->json($history);
    }
}