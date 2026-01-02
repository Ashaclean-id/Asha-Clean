<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('bookings', function (Blueprint $table) {
        // Menyimpan harga deal saat booking terjadi
        $table->decimal('total_price', 12, 0)->after('service_id')->default(0);
        
        // Status pembayaran: unpaid (belum), paid (lunas), expired (kadaluarsa), cancelled, dll
        $table->string('payment_status')->default('unpaid')->after('status');
        
        // Token rahasia dari Midtrans untuk popup pembayaran
        $table->string('snap_token')->nullable()->after('payment_status');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
};
