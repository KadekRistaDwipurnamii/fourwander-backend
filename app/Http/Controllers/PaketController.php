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

        // FILTER
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

            $diskon = (int) ($p->diskon ?? 0);

            $p->image_url = $p->image
                ? url('/images/paket/' . $p->image)
                : null;

            $p->harga_asli = $p->harga;
            $p->diskon = $diskon;
            $p->harga_setelah_diskon = max(0, $p->harga - $diskon);

            return $p;
        });

        return response()->json($pakets);
    }

    /**
     * ===============================
     * DETAIL PAKET
     * ===============================
     */
    public function show($id)
    {
        $paket = Paket::findOrFail($id);

        $diskon = (int) ($paket->diskon ?? 0);

        $paket->image_url = $paket->image
            ? url('/images/paket/' . $paket->image)
            : null;

        $paket->gallery = is_array($paket->images)
            ? collect($paket->images)->map(fn ($img) => url('/images/paket/' . $img))->toArray()
            : [];

        $paket->fasilitas = $paket->fasilitas ?? [];
        $paket->itinerary = $paket->itinerary ?? [];

        return response()->json([
            'paket' => $paket,
            'harga_asli' => $paket->harga,
            'diskon' => $diskon,
            'harga_setelah_diskon' => max(0, $paket->harga - $diskon),
        ]);
    }
}
