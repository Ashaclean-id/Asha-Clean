<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_pages', function (Blueprint $table) {
        // Hapus "->after('price')"
        $table->string('duration')->nullable(); 

        // Hapus "->after('duration')" (biar aman taruh di urutan akhir aja)
        $table->string('team_size')->nullable(); 
        $table->decimal('rating', 3, 1)->default(5.0);
        $table->boolean('is_active')->default(true);
    });
    }

    public function down(): void
    {
        Schema::table('service_pages', function (Blueprint $table) {
            $table->dropColumn(['duration', 'team_size', 'rating', 'is_active']);
        });
    }
};