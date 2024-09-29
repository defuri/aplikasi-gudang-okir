<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

class penjualan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();

        DB::table('penjualan')->truncate();

        DB::table('penjualan')->insert([
            [
                'tanggal' => Carbon::now(),
                'id_produk' => 1,
                'jumlah' => 300,
                'omzet' => 2250000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'tanggal' => Carbon::now(),
                'id_produk' => 2,
                'jumlah' => 400,
                'omzet' => 3400000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
