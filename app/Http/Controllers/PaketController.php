<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * ===============================
     * LIST PAKET
     * ===============================
     */
    public function index(Request $request)
    {
        $query = Paket::query();

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

        $pakets = $query->paginate(6);

        $pakets->getCollection()->transform(function ($p) {
            $p->image_url = $p->image
                ? secure_url('images/paket/' . $p->image)
                : null;

            return $p;
        });

        return response()->json($pakets);
    }

    /**
     * ===============================
     * DETAIL BY ID (BACKUP)
     * ===============================
     */
    public function show($id)
    {
        $paket = Paket::findOrFail($id);
        return $this->formatDetail($paket);
    }

    /**
     * ===============================
     * DETAIL BY SLUG (SEO)
     * ===============================
     */
    public function showBySlug($slug)
    {
        if (!$slug || $slug === 'undefined') {
            return response()->json([
                'message' => 'Slug tidak valid'
            ], 400);
        }

        $paket = Paket::where('slug', $slug)->firstOrFail();
        return $this->formatDetail($paket);
    }

    /**
     * ===============================
     * FORMAT RESPONSE
     * ===============================
     */
    private function formatDetail(Paket $paket)
    {
        $paket->image_url = $paket->image
            ? secure_url('images/paket/' . $paket->image)
            : null;

        $paket->gallery = is_array($paket->images)
            ? collect($paket->images)->map(fn ($img) => secure_url('images/paket/' . $img))->toArray()
            : [];

        $paket->fasilitas = is_array($paket->fasilitas) ? $paket->fasilitas : [];
        $paket->itinerary = is_array($paket->itinerary) ? $paket->itinerary : [];

        return response()->json([
            'paket' => $paket,
            'harga_asli' => $paket->harga,
            'diskon' => 0,
            'harga_setelah_diskon' => $paket->harga,
        ]);
    }
}
