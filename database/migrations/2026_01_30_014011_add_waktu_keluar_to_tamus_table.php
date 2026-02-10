<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('tamus', function (Blueprint $table) {
        // Menambahkan kolom datetime setelah waktu_kedatangan
        $table->datetime('waktu_keluar')->nullable()->after('waktu_kedatangan');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            //
        });
    }
};
