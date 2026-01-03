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
            // Kita tambahkan kolom user_id setelah kolom id
            // nullable() artinya boleh kosong (untuk jaga-jaga kalau ada tamu/guest)
            // constrained() otomatis menyambungkan ke tabel users
            // onDelete('cascade') artinya kalau user dihapus, data bookingnya ikut kehapus (opsional)
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Hapus foreign key dulu, baru kolomnya
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};