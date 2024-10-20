<?php

namespace Database\Seeders;

use App\Models\DetailPenjualan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailPenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DetailPenjualan::truncate();

        DetailPenjualan::create([
            'penjualan_id' => 1,
            'produk_id' => 1,
            'jumlah' => 5,
            'omzet' => 37500,
        ]);

        DetailPenjualan::create([
            'penjualan_id' => 2,
            'produk_id' => 2,
            'jumlah' => 10,
            'omzet' => 85000,
        ]);
    }
}
