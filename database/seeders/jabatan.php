<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class jabatan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();

        DB::table('jabatan')->truncate();

        DB::table('jabatan')->insert([
            [
                'nama' => 'karyawan produksi',
                'gaji' => 3000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'sopir',
                'gaji' => 3000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
