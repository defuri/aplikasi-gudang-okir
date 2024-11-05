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
        // membuat tabel gudang
        Schema::create('gudang', function(Blueprint $table) {
            $table->id();
            $table->string('nama', 40)->unique();
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // menghapus tabel gudang
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('gudang');
        Schema::enableForeignKeyConstraints();
    }
};
