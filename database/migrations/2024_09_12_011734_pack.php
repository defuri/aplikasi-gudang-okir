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
        // membuat tabel pack
        Schema::create('pack', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 40)->unique();
            $table->integer('ukuran');
            $table->unsignedBigInteger('id_satuan');
            $table->timestamps();
            $table->foreign('id_satuan')->references('id')->on('satuan')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // menghapus tabel pack
        Schema::dropIfExists('pack');
    }
};
