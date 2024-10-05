<?php

namespace Database\Seeders;

use App\Models\DetailPesanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DetailPesanan::truncate();

        DB::table('detail_pesanan')->insert([
            [
                'pesanan_id' => 1,
                'produk_id' => 1,
                'jumlah' => 30,
                'total' => 225000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pesanan_id' => 1,
                'produk_id' => 2,
                'jumlah' => 20,
                'total' => 170000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pesanan_id' => 2,
                'produk_id' => 1,
                'jumlah' => 33,
                'total' => 247500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pesanan_id' => 2,
                'produk_id' => 2,
                'jumlah' => 89,
                'total' => 756500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
