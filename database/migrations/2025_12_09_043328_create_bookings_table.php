<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('email')->nullable();
        $table->string('hp');
        $table->integer('jumlah_orang');
        $table->date('tanggal');
        $table->foreignId('paket_id')->constrained('paket');
        $table->json('extra')->nullable();
        $table->text('catatan')->nullable();
        $table->integer('total_harga');
        $table->timestamps();
    });

    }

    public function down(): void {
        Schema::dropIfExists('bookings');
    }
};
