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
        // membuat tabel bahan baku
        Schema::create('bahan_baku', function(Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->unique();
            $table->unsignedBigInteger('id_suplier');
            $table->timestamps();
            $table->foreign('id_suplier')->references('id')->on('suplier')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // menghapus tabel bahan baku
        Schema::dropIfExists('bahan_baku');
    }
};
