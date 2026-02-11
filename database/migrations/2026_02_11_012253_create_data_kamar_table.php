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
        Schema::create('data_kamar', function (Blueprint $table) {
            $table->string('id_kamar')->primary();
            $table->integer('nomor_kamar');
            $table->enum('tipe_kamar', ['Standard', 'Deluxe', 'Suite'])->onDefault('Standard');
            $table->decimal('harga_kamar', 10, 2);
            $table->enum('status_kamar', ['Tersedia', 'Tidak Tersedia'])->onDefault('Tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kamar');
    }
};
