<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Paket;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * =====================================
     * CREATE BOOKING (CHECKOUT)
     * =====================================
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'          => 'required|string',
            'email'         => 'nullable|email',
            'hp'            => 'required|string',
            'jumlah_orang'  => 'required|integer|min:1',
            'tanggal'       => 'required|date',
            'paket_id'      => 'required|exists:paket,id',
            'extra'         => 'nullable|array',
            'catatan'       => 'nullable|string',
            'total_harga'   => 'required|integer', // subtotal dari frontend
        ]);

        // Ambil paket
        $paket = Paket::findOrFail($data['paket_id']);

        // ✅ DISKON FINAL (AMBIL LANGSUNG DARI KOLOM PAKET)
        $diskon = (int) ($paket->diskon ?? 0);

        // Hitung total akhir
        $totalAkhir = max(0, $data['total_harga'] - $diskon);

        // Simpan booking
        $booking = Booking::create([
            'user_id'        => auth()->id(),
            'nama'           => $data['nama'],
            'email'          => $data['email'],
            'hp'             => $data['hp'],
            'jumlah_orang'   => $data['jumlah_orang'],
            'tanggal'        => $data['tanggal'],
            'paket_id'       => $data['paket_id'],
            'extra'          => $data['extra'] ?? [],
            'catatan'        => $data['catatan'] ?? null,

            'total_harga'    => $data['total_harga'], // harga awal
            'diskon'         => $diskon,               // ✅ DISKON MASUK
            'total_akhir'    => $totalAkhir,

            'status'         => 'UNPAID',
        ]);

        return response()->json([
            'success'    => true,
            'booking_id' => $booking->id,
        ], 201);
    }

    /**
     * =====================================
     * PAYMENT (SET STATUS PAID)
     * =====================================
     */
    public function pay(Request $request, $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);
        }

        $booking->payment_method    = $request->payment_method ?? 'UNKNOWN';
        $booking->payment_reference = $request->payment_reference ?? null;
        $booking->status            = 'PAID';
        $booking->save();

        return response()->json([
            'success' => true,
            'pdf_url' => url("/api/booking/$id/invoice")
        ]);
    }

    /**
     * =====================================
     * INVOICE PDF
     * =====================================
     */
    public function invoice($id)
    {
        $booking = Booking::with('paket')->findOrFail($id);

        return Pdf::loadView('pdf.booking', compact('booking'))
            ->stream("booking_$id.pdf");
    }

    /**
     * =====================================
     * ADMIN - LIST BOOKING
     * =====================================
     */
    public function index()
    {
        $bookings = Booking::with('paket')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($bookings);
    }
}
