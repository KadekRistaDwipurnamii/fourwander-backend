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

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->min_harga) {
            $query->where('harga', '>=', $request->min_harga);
        }

        if ($request->max_harga) {
            $query->where('harga', '<=', $request->max_harga);
        }

        if ($request->q) {
            $query->where('nama', 'LIKE', '%' . $request->q . '%');
        }

        $perPage = $request->query('per_page', 6);
        $pakets = $query->paginate($perPage);

        $today = Carbon::today();

        $pakets->getCollection()->transform(function ($p) use ($today) {

            // IMAGE
            $p->image_url = $p->image
                ? secure_url('images/paket/' . $p->image)
                : null;

            // HITUNG DISKON
            $diskon = 0;
            if ($p->discount && $p->discount->is_active) {
                try {
                    $mulai = Carbon::parse($p->discount->mulai);
                    $berakhir = Carbon::parse($p->discount->berakhir);

                    if ($today->between($mulai, $berakhir)) {
                        $diskon = (int) $p->discount->potongan;
                    }
                } catch (\Throwable $e) {
                    $diskon = 0;
                }
            }

            $p->harga_asli = $p->harga;
            $p->diskon = $diskon;
            $p->harga_setelah_diskon = max(0, $p->harga - $diskon);

            return $p;
        });

        return response()->json($pakets);
    }

    /**
     * ===================================
     * DETAIL PAKET (OLD - BY ID)
     * ===================================
     */
    public function show($id)
    {
        $paket = Paket::with('discount')->findOrFail($id);
        return $this->formatDetail($paket);
    }

    /**
     * ===================================
     * DETAIL PAKET (SEO - BY SLUG)
     * ===================================
     */
    public function showBySlug($slug)
    {
        if (!$slug || $slug === 'undefined') {
            return response()->json([
                'message' => 'Slug tidak valid'
            ], 400);
        }

        $paket = Paket::with('discount')
            ->where('slug', $slug)
            ->firstOrFail();

        return $this->formatDetail($paket);
    }

    /**
     * ===================================
     * FORMAT DETAIL RESPONSE
     * ===================================
     */
    private function formatDetail(Paket $paket)
    {
        $today = Carbon::today();

        $paket->image_url = $paket->image
            ? secure_url('images/paket/' . $paket->image)
            : null;

        $images = json_decode($paket->images ?? '[]', true);
        $paket->gallery = collect($images)->map(fn ($img) =>
            secure_url('images/paket/' . $img)
        )->toArray();

        $paket->fasilitas = json_decode($paket->fasilitas ?? '[]', true);
        $paket->itinerary = json_decode($paket->itinerary ?? '[]', true);

        $diskon = 0;
        if ($paket->discount && $paket->discount->is_active) {
            try {
                $mulai = Carbon::parse($paket->discount->mulai);
                $berakhir = Carbon::parse($paket->discount->berakhir);

                if ($today->between($mulai, $berakhir)) {
                    $diskon = (int) $paket->discount->potongan;
                }
            } catch (\Throwable $e) {
                $diskon = 0;
            }
        }

        return response()->json([
            'paket' => $paket,
            'harga_asli' => $paket->harga,
            'diskon' => $diskon,
            'harga_setelah_diskon' => max(0, $paket->harga - $diskon),
        ]);
    }
}
