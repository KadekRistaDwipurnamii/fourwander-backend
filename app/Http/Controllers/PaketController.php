<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaketController extends Controller
{
    /**
     * ===============================
     * LIST PAKET (HOME / LISTING)
     * ===============================
     */
    public function index(Request $request)
    {
        $query = Paket::with('discount');

        // FILTER KATEGORI
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        // FILTER HARGA
        if ($request->min_harga) {
            $query->where('harga', '>=', $request->min_harga);
        }

        if ($request->max_harga) {
            $query->where('harga', '<=', $request->max_harga);
        }

        // SEARCH NAMA
        if ($request->q) {
            $query->where('nama', 'LIKE', '%' . $request->q . '%');
        }

        // PAGINATION
        $perPage = $request->query('per_page', 6);
        $pakets = $query->paginate($perPage);

        $today = Carbon::today();

        // TRANSFORM DATA
        $pakets->getCollection()->transform(function ($p) use ($today) {

            // IMAGE UTAMA
            $p->image_url = $p->image
                ? url('/images/paket/' . $p->image)
                : null;

            // DISKON
            $diskon = 0;
            if (
                $p->discount &&
                $p->discount->is_active &&
                $today->between(
                    $p->discount->mulai,
                    $p->discount->berakhir
                )
            ) {
                $diskon = $p->discount->potongan;
            }

            $p->diskon = $diskon;
            $p->harga_asli = $p->harga;
            $p->harga_setelah_diskon = max(0, $p->harga - $diskon);

            return $p;
        });

        return response()->json($pakets);
    }

    /**
     * ===============================
     * DETAIL PAKET (CHECKOUT)
     * ===============================
     */
    public function show($id)
    {
        $paket = Paket::with('discount')->findOrFail($id);

        $today = Carbon::today();

        // IMAGE UTAMA
        $paket->image_url = $paket->image
            ? url('/images/paket/' . $paket->image)
            : null;

        // GALERI (JSON images)
        if ($paket->images) {
            $paket->gallery = collect($paket->images)->map(function ($img) {
                return url('/images/paket/' . $img);
            })->toArray();
        } else {
            $paket->gallery = [];
        }

        // FASILITAS & ITINERARY
        $paket->fasilitas = $paket->fasilitas ?? [];
        $paket->itinerary = $paket->itinerary ?? [];

        // DISKON
        $diskon = 0;
        if (
            $paket->discount &&
            $paket->discount->is_active &&
            $today->between(
                $paket->discount->mulai,
                $paket->discount->berakhir
            )
        ) {
            $diskon = $paket->discount->potongan;
        }

        return response()->json([
            'paket' => $paket,
            'harga_asli' => $paket->harga,
            'diskon' => $diskon,
            'harga_setelah_diskon' => max(0, $paket->harga - $diskon),
        ]);
    }
}
