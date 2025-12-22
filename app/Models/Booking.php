<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'hp',
        'jumlah_orang',
        'tanggal',
        'paket_id',
        'extra',
        'catatan',
        'total_harga',
        'diskon',
        'total_akhir',
        'status',
        'payment_method',
        'payment_reference',
    ];

    protected $casts = [
        'extra' => 'array',
        'tanggal' => 'date',
    ];

    public function paket(){
        return $this->belongsTo(Paket::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
