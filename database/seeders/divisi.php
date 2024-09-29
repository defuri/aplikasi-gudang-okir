<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class divisi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();

        DB::table('divisi')->truncate();

        DB::table('divisi')->insert([
            [
                'nama' => 'produksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'gudang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'lapangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'administrasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
