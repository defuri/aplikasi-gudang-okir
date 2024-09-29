<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class gudang extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();

        DB::table('gudang')->truncate();

        DB::table('gudang')->insert([
            [
                'nama' => 'Gudang 1',
                'Alamat' => 'Jl In aja Dulu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Gudang 2',
                'Alamat' => 'Jl Menuju Kebenaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
