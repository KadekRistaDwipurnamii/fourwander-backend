<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paket;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            [
                "id" => 1,
                "nama" => "Ubud One-Day Culture Tour",
                "kategori" => "One-Day",
                "durasi" => "1 Hari",
                "harga" => 450000,
                "deskripsi" => "Wisata budaya Ubud: sawah Tegalalang, Monkey Forest, dan pusat seni Ubud.",
                "fasilitas" => json_encode([
                    "Transport AC",
                    "Driver + Guide",
                    "Tiket masuk objek wisata",
                    "Air mineral"
                ]),
                "itinerary" => json_encode([
                    "Penjemputan hotel",
                    "Monkey Forest",
                    "Tegalalang Rice Terrace",
                    "Pasar Seni Ubud",
                    "Kembali ke hotel"
                ])
            ],
            [
                "id" => 2,
                "nama" => "Kintamani Volcano Day Tour",
                "kategori" => "One-Day",
                "durasi" => "1 Hari",
                "harga" => 500000,
                "deskripsi" => "Melihat pemandangan Gunung dan Danau Batur dari Kintamani.",
                "fasilitas" => json_encode(["Transport", "Guide", "Tiket wisata", "Makan siang (opsional)"]),
                "itinerary" => json_encode([
                    "Penjemputan",
                    "Tirta Empul",
                    "Kintamani View Point",
                    "Coffee Plantation",
                    "Kembali ke hotel"
                ])
            ],
            [
                "id" => 3,
                "nama" => "Bedugul – Ulun Danu One-Day Tour",
                "kategori" => "One-Day",
                "durasi" => "1 Hari",
                "harga" => 450000,
                "deskripsi" => "Mengunjungi ikon wisata Danau Beratan, Pasar Candi Kuning, dan Handara Gate.",
                "fasilitas" => json_encode(["Transport", "Driver", "Tiket wisata"]),
                "itinerary" => json_encode([
                    "Penjemputan",
                    "Ulun Danu Beratan",
                    "Handara Gate",
                    "Pasar Candi Kuning",
                    "Kembali"
                ])
            ],
            [
                "id" => 4,
                "nama" => "Tanah Lot Sunset Trip",
                "kategori" => "One-Day",
                "durasi" => "1 Hari",
                "harga" => 400000,
                "deskripsi" => "Menikmati keindahan sunset di Pura Tanah Lot dengan spot foto terbaik.",
                "fasilitas" => json_encode(["Transport", "Guide", "Tiket masuk"]),
                "itinerary" => json_encode([
                    "Penjemputan",
                    "Mengunjungi Tanah Lot",
                    "Sunset view",
                    "Kembali"
                ])
            ],
            [
                "id" => 5,
                "nama" => "Uluwatu Sunset + Kecak Dance",
                "kategori" => "One-Day",
                "durasi" => "1 Hari",
                "harga" => 550000,
                "deskripsi" => "Wisata pantai selatan Bali dan menonton Tari Kecak terkenal di Uluwatu.",
                "fasilitas" => json_encode(["Transport", "Guide", "Tiket Uluwatu", "Tiket Kecak"]),
                "itinerary" => json_encode([
                    "Pantai Pandawa (opsional)",
                    "Pura Uluwatu",
                    "Kecak Dance Performance",
                    "Kembali"
                ])
            ],
            [
                "id" => 6,
                "nama" => "East Bali Island Tour – Tirta Gangga & Lempuyang",
                "kategori" => "Island Tour",
                "durasi" => "1 Hari Full",
                "harga" => 600000,
                "deskripsi" => "Eksplorasi Bali Timur seperti Tirta Gangga, Lempuyang Gate of Heaven, dan Virgin Beach.",
                "fasilitas" => json_encode(["Transport", "Driver", "Tiket wisata", "Air mineral"]),
                "itinerary" => json_encode([
                    "Penjemputan pagi",
                    "Lempuyang Temple",
                    "Tirta Gangga",
                    "Virgin Beach",
                    "Kembali"
                ])
            ],
            [
                "id" => 7,
                "nama" => "North Bali Island Tour – Lovina Dolphin",
                "kategori" => "Island Tour",
                "durasi" => "1 Hari",
                "harga" => 650000,
                "deskripsi" => "Berburu lumba-lumba di Lovina saat sunrise dan mengunjungi air terjun Gitgit.",
                "fasilitas" => json_encode(["Transport", "Boat Dolphin Tour", "Guide", "Tiket wisata"]),
                "itinerary" => json_encode([
                    "Penjemputan dini hari",
                    "Lovina Dolphin Watching",
                    "Air Terjun Gitgit",
                    "Kembali"
                ])
            ],
            [
                "id" => 8,
                "nama" => "Central Bali Island Trip – Waterfall Explorer",
                "kategori" => "Island Tour",
                "durasi" => "1 Hari",
                "harga" => 550000,
                "deskripsi" => "Wisata alam Bali tengah: Kanto Lampo Waterfall, Tegenungan, dan Tibumana.",
                "fasilitas" => json_encode(["Transport", "Guide", "Tiket wisata"]),
                "itinerary" => json_encode([
                    "Tegenungan Waterfall",
                    "Kanto Lampo",
                    "Tibumana",
                    "Kembali"
                ])
            ],
            [
                "id" => 9,
                "nama" => "Bali Full Trip Explorer 4H3M",
                "kategori" => "Full Trip",
                "durasi" => "4 Hari 3 Malam",
                "harga" => 2900000,
                "deskripsi" => "Paket lengkap untuk menikmati wisata utama Bali.",
                "fasilitas" => json_encode([
                    "Hotel 3 malam",
                    "Breakfast",
                    "Transport full",
                    "Guide",
                    "Tiket wisata",
                    "Air mineral"
                ]),
                "itinerary" => json_encode([
                    "Hari 1: Penjemputan + Uluwatu",
                    "Hari 2: Ubud Tour",
                    "Hari 3: Kintamani – Tirta Empul",
                    "Hari 4: Check-out"
                ])
            ],
            [
                "id" => 10,
                "nama" => "Bali Family Holiday 5H4M",
                "kategori" => "Full Trip",
                "durasi" => "5 Hari 4 Malam",
                "harga" => 3500000,
                "deskripsi" => "Paket liburan keluarga dengan itinerary santai dan ramah anak.",
                "fasilitas" => json_encode([
                    "Hotel 4 malam",
                    "Breakfast",
                    "Transport AC",
                    "Guide",
                    "Tiket wisata",
                    "Makan 1x"
                ]),
                "itinerary" => json_encode([
                    "Hari 1: Penjemputan + Pantai Kuta",
                    "Hari 2: Bali Safari (opsional)",
                    "Hari 3: Bedugul Tour",
                    "Hari 4: Ubud Art Tour",
                    "Hari 5: Check-out"
                ])
            ],
        ];

        foreach ($data as $item) {
            Paket::create($item);
        }
    }
}
