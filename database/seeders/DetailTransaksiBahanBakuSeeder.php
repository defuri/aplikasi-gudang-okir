<?php

namespace Database\Seeders;

use App\Models\DetailTransaksiBahanBaku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DetailTransaksiBahanBakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('detail_transaksi_bahan_baku')->truncate();

        DetailTransaksiBahanBaku::create([
            'transaksi_bahan_baku_id' => 1,
            'bahan_baku_id' => 1,
            'jumlah' => 10,
            'satuan_id' => 1,
            'harga' => 7000,
            'total' => 70000,
        ]);

        DetailTransaksiBahanBaku::create([
            'transaksi_bahan_baku_id' => 2,
            'bahan_baku_id' => 2,
            'jumlah' => 10,
            'satuan_id' => 1,
            'harga' => 10000,
            'total' => 100000,
        ]);

        DetailTransaksiBahanBaku::create([
            'transaksi_bahan_baku_id' => 3,
            'bahan_baku_id' => 3,
            'jumlah' => 50,
            'satuan_id' => 2,
            'harga' => 150000,
            'total' => 750000,
        ]);

        DetailTransaksiBahanBaku::create([
            'transaksi_bahan_baku_id' => 4,
            'bahan_baku_id' => 4,
            'jumlah' => 75,
            'satuan_id' => 3,
            'harga' => 200000,
            'total' => 1500000,
        ]);

        DetailTransaksiBahanBaku::create([
            'transaksi_bahan_baku_id' => 5,
            'bahan_baku_id' => 5,
            'jumlah' => 25,
            'satuan_id' => 4,
            'harga' => 120000,
            'total' => 300000,
        ]);
    }
}
