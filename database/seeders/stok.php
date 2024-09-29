<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class stok extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();

        DB::table('stok')->truncate();

        DB::table('stok')->insert([
            [
                'id_gudang' => 1,
                'id_produk' => 1,
                'stok' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_gudang' => 1,
                'id_produk' => 2,
                'stok' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
