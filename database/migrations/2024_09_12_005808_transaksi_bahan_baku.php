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
        // membuat tabel transaksi bahan baku
        Schema::create('transaksi_bahan_baku', function(Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->unsignedBigInteger('id_bahan_baku');
            $table->integer('jumlah');
            $table->unsignedBigInteger('id_satuan');
            $table->integer('harga');
            $table->timestamps();
            $table->foreign('id_bahan_baku')->references('id')->on('bahan_baku')->onDelete('cascade');
            $table->foreign('id_satuan')->references('id')->on('satuan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        // menghapus tabel transaksi bahan baku
        Schema::dropIfExists('transaksi_bahan_baku');

        Schema::enableForeignKeyConstraints();
    }
};
