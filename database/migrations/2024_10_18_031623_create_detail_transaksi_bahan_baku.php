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
        Schema::create('detail_transaksi_bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_bahan_baku_id');
            $table->unsignedBigInteger('bahan_baku_id');
            $table->integer('jumlah');
            $table->unsignedBigInteger('satuan_id');
            $table->integer('harga');
            $table->integer('total');
            $table->foreign('transaksi_bahan_baku_id')->references('id')->on('transaksi_bahan_baku')->onDelete('cascade');
            $table->foreign('bahan_baku_id')->references('id')->on('bahan_baku')->onDelete('cascade');
            $table->foreign('satuan_id')->references('id')->on('satuan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi_bahan_baku');
    }
};
