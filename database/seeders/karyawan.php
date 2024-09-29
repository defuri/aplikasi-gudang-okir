<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class karyawan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();

        DB::table('karyawan')->truncate();

        DB::table('karyawan')->insert([
            [
                'nama' => 'Ujang',
                'id_jabatan' => 2,
                'id_divisi' => 3,
                'Alamat' => 'Jl Jalan Bersamanya',
                'no_tlp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'asep',
                'id_jabatan' => 1,
                'id_divisi' => 1,
                'Alamat' => 'Jl Sejenak Untuk Melepaskan Penat',
                'no_tlp' => '081234567891',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
