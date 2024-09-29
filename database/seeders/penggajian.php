<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class penggajian extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();

        DB::table('penggajian')->truncate();

        DB::table('penggajian')->insert([
            [
                'tanggal' => Carbon::now(),
                'id_karyawan' => 1,
                'id_jabatan' => 2,
                'lembur' => 0,
                'total' => 3000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::now(),
                'id_karyawan' => 2,
                'id_jabatan' => 1,
                'lembur' => 0,
                'total' => 3000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
