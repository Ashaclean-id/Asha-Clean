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
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        // Relasi ke Layanan (Opsional, kalau ulasan ini spesifik untuk layanan tertentu)
        $table->foreignId('service_id')->nullable()->constrained()->onDelete('cascade');
        
        $table->string('name');
        $table->string('email')->nullable();
        $table->integer('rating'); // 1 sampai 5
        $table->text('content');
        
        // Status: pending (menunggu persetujuan), approved (tampil), hidden (disembunyikan)
        $table->enum('status', ['pending', 'approved', 'hidden'])->default('pending');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
