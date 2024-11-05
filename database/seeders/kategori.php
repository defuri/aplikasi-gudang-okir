<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class kategori extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();

        DB::table('kategori')->truncate();

        DB::table('kategori')->insert([
            [
                'nama' => 'basreng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'singkong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'brekele',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'cikruh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'pisang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
