<?php

namespace Database\Seeders;

use App\Models\ProdukKeluarModel;
use App\Models\stokModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukKeluarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProdukKeluarModel::truncate();

        DB::table('produk_keluar')->insert([
            [
                'id_gudang' => 1,
                'id_produk' => 1,
                'jumlah' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_gudang' => 1,
                'id_produk' => 2,
                'jumlah' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Decrement stock as before
        StokModel::where('id_gudang', 1)->where('id_produk', 1)->decrement('stok', 10);
        StokModel::where('id_gudang', 1)->where('id_produk', 2)->decrement('stok', 10);

        // Update timestamps
        StokModel::where(function ($query) {
            $query->where('id_gudang', 1)->where('id_produk', 1);
        })->orWhere(function ($query) {
            $query->where('id_gudang', 1)->where('id_produk', 2);
        })->update(['updated_at' => now()]);
    }

}
