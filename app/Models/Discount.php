<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'paket_id',
        'potongan',
        'mulai',
        'berakhir',
        'is_active'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
}
