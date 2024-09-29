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
        // membuat tabel kategori
        Schema::create('kategori', function(Blueprint $table) {
            $table->id();
            $table->string('nama', 40)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // menghapus tabel kategori
        Schema::dropIfExists('kategori');
    }
};
