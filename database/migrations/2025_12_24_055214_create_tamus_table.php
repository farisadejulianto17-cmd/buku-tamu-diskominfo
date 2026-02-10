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
    Schema::create('tamus', function (Blueprint $table) {
        $table->id('unique_id'); // Primary Key
        $table->string('nama', 25); // varchar 25
        $table->string('instansi', 50); // varchar 50
        $table->string('kebutuhan', 100); // varchar 100
        $table->dateTime('waktu_kedatangan'); // date_time
        $table->timestamp('jam_keluar')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamus');
    }
};
