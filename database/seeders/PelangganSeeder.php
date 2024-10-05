<?php

namespace Database\Seeders;

use App\Models\pelanggan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        pelanggan::truncate();
        Schema::enableForeignKeyConstraints();
        pelanggan::factory()->count(5)->create();
    }
}
