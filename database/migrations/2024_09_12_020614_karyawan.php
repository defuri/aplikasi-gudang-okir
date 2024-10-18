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
        //
        Schema::create('karyawan', function(Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->unsignedBigInteger('id_jabatan');
            $table->unsignedBigInteger('id_divisi');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->text('alamat');
            $table->string('no_tlp', 30)->unique();
            $table->timestamps();
            $table->foreign('id_jabatan')->references('id')->on('jabatan')->onDelete('cascade');
            $table->foreign('id_divisi')->references('id')->on('divisi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('karyawan');
    }
};
