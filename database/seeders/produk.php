<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class produk extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Schema::disableForeignKeyConstraints();

        DB::table('produk')->truncate();

        DB::table('produk')->insert([
            [
                'nama' => 'Basreng Stik Pedas Kecil',
                'id_rasa' => 2,
                'id_kategori' => 1,
                'id_pack' => 1,
                'harga' => 7500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Basreng Stik Pedas Besar',
                'id_rasa' => 2,
                'id_kategori' => 1,
                'id_pack' => 2,
                'harga' => 8500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
