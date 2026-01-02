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
    Schema::create('services', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('short_description')->nullable();
        $table->longText('full_description')->nullable();
        
        // --- INI TAMBAHANNYA SUPAYA SESUAI DESAIN ---
        $table->decimal('price', 12, 0)->default(0);
        $table->string('duration')->nullable();      
        $table->integer('team_size')->default(1);    // Untuk "Jumlah Tim"
        $table->boolean('show_booking')->default(true); // Toggle "Tampilkan Tombol"
        $table->string('booking_label')->default('Pesan Sekarang'); // Input "Label Tombol"
        
        $table->string('image')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
