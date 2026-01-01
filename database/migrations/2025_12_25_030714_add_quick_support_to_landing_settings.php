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
    Schema::table('landing_settings', function (Blueprint $table) {
        $table->boolean('show_quick_support')->default(false); // Untuk Toggle ON/OFF
        $table->string('whatsapp_number')->nullable();         // Untuk simpan Nomor WA
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('landing_settings', function (Blueprint $table) {
            //
        });
    }
};
