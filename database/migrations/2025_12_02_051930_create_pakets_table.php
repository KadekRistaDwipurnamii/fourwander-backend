<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori');
            $table->string('durasi');
            $table->integer('harga');
            $table->text('deskripsi');
            $table->json('fasilitas')->nullable();
            $table->json('itinerary')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};
