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

        Schema::create('hak', function(Blueprint $table) {
            $table->id();
            $table->string('nama', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('hak');
        Schema::enableForeignKeyConstraints();
    }
};
