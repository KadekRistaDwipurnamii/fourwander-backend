<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Paket;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $totalBooking = Booking::count();

        $pendapatan = Booking::where('status', 'PAID')
            ->sum('total_akhir');

        // fallback kalau total_akhir masih NULL
        if ($pendapatan == 0) {
            $pendapatan = Booking::where('status', 'PAID')
                ->sum('total_harga');
        }

        $paketAktif = Paket::count();

        $userBaru = User::count();

        $bookingTerbaru = Booking::with('paket')
            ->latest()
            ->limit(5)
            ->get();

        return response()->json([
            'total_booking' => $totalBooking,
            'pendapatan' => $pendapatan,
            'paket_aktif' => $paketAktif,
            'user_baru' => $userBaru,
            'booking_terbaru' => $bookingTerbaru
        ]);
    }
}
