<?php

namespace Database\Seeders;

use App\Models\Pesanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        Pesanan::truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('pesanan')->insert([
            [
                'pelanggan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelanggan_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
