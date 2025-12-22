<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'paket';

    protected $fillable = [
        'nama',
        'kategori',
        'durasi',
        'harga',
        'diskon',
        'image',
        'images',
        'deskripsi',
        'fasilitas',
        'itinerary',
    ];

    protected $casts = [
        'fasilitas' => 'array',
        'itinerary' => 'array',
        'images' => 'array'
    ];

    public function discount()
    {
        return $this->hasOne(\App\Models\Discount::class);
    }
}


