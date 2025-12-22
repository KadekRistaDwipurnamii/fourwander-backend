<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('sender_name')->nullable()->after('payment_reference');
            $table->string('sender_account')->nullable()->after('sender_name');
            $table->string('ewallet_type')->nullable()->after('sender_account');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'sender_name',
                'sender_account',
                'ewallet_type'
            ]);
        });
    }
};
