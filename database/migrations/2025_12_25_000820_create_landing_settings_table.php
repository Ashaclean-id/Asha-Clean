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
    Schema::create('landing_settings', function (Blueprint $table) {
        $table->id();
        // Hero Section
        $table->string('hero_title')->default('Layanan Kebersihan Profesional');
        $table->text('hero_description')->nullable();
        
        // Promo Section (3 Kolom)
        $table->string('promo_1_text')->nullable();
        $table->string('promo_1_image')->nullable();
        
        $table->string('promo_2_text')->nullable();
        $table->string('promo_2_image')->nullable();
        
        $table->string('promo_3_text')->nullable();
        $table->string('promo_3_image')->nullable();

        // Toggle Ulasan
        $table->boolean('show_ulasan')->default(true);
        
        $table->timestamps();
    });
}
};
