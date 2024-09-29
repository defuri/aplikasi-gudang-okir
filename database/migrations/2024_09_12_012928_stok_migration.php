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
        // membuat tabel detail gudang
        Schema::create('stok', function(Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->unsignedBigInteger('id_gudang');
            $table->unsignedBigInteger('id_produk');
            $table->integer('stok');
            $table->timestamps();
            $table->foreign('id_gudang')->references('id')->on('gudang')->onDelete('cascade');
            $table->foreign('id_produk')->references('id')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // menghapus tabel detail gudang
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('stok');
        Schema::enableForeignKeyConstraints();
    }
};
