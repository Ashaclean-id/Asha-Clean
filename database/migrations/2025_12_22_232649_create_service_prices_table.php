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
    Schema::create('service_prices', function (Blueprint $table) {
        $table->id();
        // Menghubungkan harga ke layanan tertentu (Relasi)
        $table->foreignId('service_page_id')->constrained('service_pages')->onDelete('cascade');
        $table->string('name'); // Contoh: "Ukuran King (180x200)"
        $table->decimal('price', 12, 0); // Contoh: 250000
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('service_prices');
}
};
