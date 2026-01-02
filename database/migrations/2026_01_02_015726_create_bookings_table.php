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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        
        // Relasi ke Layanan
        $table->foreignId('service_id')->constrained()->onDelete('cascade');
        
        // Data Pemesan
        $table->string('name');
        $table->string('phone'); // No WA
        $table->text('address');
        $table->date('booking_date');
        $table->string('booking_time'); // Jam (08:00, 09:00, dll)
        $table->text('notes')->nullable(); // Catatan tambahan
        
        // Status Pesanan (Pending, Confirmed, Completed, Cancelled)
        $table->string('status')->default('pending');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
