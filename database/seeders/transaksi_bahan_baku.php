<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class transaksi_bahan_baku extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();

        DB::table('transaksi_bahan_baku')->truncate();

        DB::table('transaksi_bahan_baku')->insert([
            [
                'tanggal' => Carbon::now(),
                'id_bahan_baku' => 1,
                'jumlah' => 300,
                'id_satuan' => 1,
                'harga' => 30000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::now(),
                'id_bahan_baku' => 2,
                'jumlah' => 200,
                'id_satuan' => 1,
                'harga' => 50000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
