<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('services', function (Blueprint $table) {
        // Kita pakai JSON agar bisa menyimpan banyak harga dalam 1 kolom
        $table->json('pricelist')->nullable()->after('price'); 
    });
}

public function down()
{
    Schema::table('services', function (Blueprint $table) {
        $table->dropColumn('pricelist');
    });
}
};
