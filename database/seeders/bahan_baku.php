<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class bahan_baku extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Schema::disableForeignKeyConstraints();

        DB::table('bahan_baku')->truncate();

        DB::table('bahan_baku')->insert([
            [
                'nama' => 'basreng',
                'id_suplier' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'singkong',
                'id_suplier' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'cabe',
                'id_suplier' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
