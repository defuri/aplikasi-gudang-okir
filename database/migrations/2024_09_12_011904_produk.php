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
        // membuat tabel produk
        Schema::create('produk', function(Blueprint $table) {
            $table->id();
            $table->string('nama', 40);
            $table->unsignedBigInteger('id_rasa');
            $table->unsignedBigInteger('id_kategori');
            $table->unsignedBigInteger('id_pack');
            $table->integer('harga');
            $table->timestamps();
            $table->foreign('id_rasa')->references('id')->on('rasa')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id')->on('kategori')->onDelete('cascade');
            $table->foreign('id_pack')->references('id')->on('pack')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // menghapus tabel produk
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('produk');
        Schema::enableForeignKeyConstraints();
    }
};
