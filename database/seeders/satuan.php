<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;

class satuan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();

        DB::table('satuan')->truncate();

        DB::table('satuan')->insert([
            [
                'nama' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'hg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'dag',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'g',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
