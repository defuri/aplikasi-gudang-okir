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
        // membuat tabel satuan
        Schema::create('satuan', function(Blueprint $table) {
            $table->id();
            $table->string('nama', 20)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // menghapus tabel satuan
        Schema::dropIfExists('satuan');
    }
};
