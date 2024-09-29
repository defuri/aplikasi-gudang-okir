<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class pack extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();

        DB::table('pack')->truncate();

        DB::table('pack')->insert([
            [
                'nama' => 'grosir kecil',
                'ukuran' => 20,
                'id_satuan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'grosir besar',
                'ukuran' => 25,
                'id_satuan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
