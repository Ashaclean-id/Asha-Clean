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
        $table->text('short_description')->nullable();
        $table->longText('full_description')->nullable();
        $table->decimal('price', 10, 2)->default(0);
        $table->string('duration')->nullable();
        $table->integer('team_size')->nullable(); // Pastikan ini ada kalau error team_size
        $table->boolean('show_booking')->default(true);
        $table->string('booking_label')->nullable();
        $table->string('slug')->unique();
        $table->string('image')->nullable();
        
        // --- KOLOM benefits dan pricelist ditambahkan di migrasi terpisah ---
        // Lihat: 2026_01_02_011655_add_benefits_to_services_table.php (menambahkan pricelist)
        // Lihat: 2026_01_02_013802_add_pricelist_to_services_table.php (duplicate, skip)
        // ---------------------------------------------------------------------

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
