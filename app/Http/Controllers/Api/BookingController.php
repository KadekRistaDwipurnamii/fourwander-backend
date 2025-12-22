<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingCreated;

class BookingController extends Controller {

    public function store(Request $request){
        $data = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'booker_name' => 'required|string|max:255',
            'booker_email' => 'required|email',
            'booker_phone' => 'nullable|string',
            'trip_date' => 'required|date',
            'participants' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $package = Package::findOrFail($data['package_id']);
        $total = $package->price * $data['participants'];

        $booking = Booking::create([
            'package_id' => $data['package_id'],
            'booker_name' => $data['booker_name'],
            'booker_email' => $data['booker_email'],
            'booker_phone' => $data['booker_phone'] ?? '',
            'trip_date' => $data['trip_date'],
            'participants' => $data['participants'],
            'total_price' => $total,
            'notes' => $data['notes'] ?? null,
            'status' => 'pending'
        ]);

        // send email (async queue is recommended)
        try {
            Mail::to($booking->booker_email)->send(new BookingCreated($booking));
        } catch (\Exception $e) {
            // log error, don't block response
        }

        return response()->json([
            'success'=>true,
            'booking'=>$booking
        ], 201);
    }

    public function show($id){
        $booking = Booking::with('package')->findOrFail($id);
        return response()->json($booking);
    }

    // admin endpoints (list bookings)
    public function index(){
        $rows = Booking::with('package')->orderBy('created_at','desc')->paginate(20);
        return response()->json($rows);
    }
}
