<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class suplier extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();

        DB::table('suplier')->truncate();

        DB::table('suplier')->insert([
            [
                'nama' => 'Suplier A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Suplier B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Suplier C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Suplier D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
