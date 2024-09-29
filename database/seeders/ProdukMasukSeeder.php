<?php

namespace Database\Seeders;

use App\Models\ProdukMasukModel;
use App\Models\stokModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ProdukMasukModel::truncate();

        DB::table('produk_masuk')->insert([
            [
                'id_gudang' => 1,
                'id_produk' => 1,
                'jumlah' => 70,
                'created_at' =>now(),
                'updated_at' => now(),
            ],
            [
                'id_gudang' => 1,
                'id_produk' => 2,
                'jumlah' => 80,
                'created_at' =>now(),
                'updated_at' => now(),
            ],
        ]);

        StokModel::where('id_gudang', 1)
            ->where('id_produk', 1)
            ->increment('stok', 70);

        StokModel::where('id_gudang', 1)
            ->where('id_produk', 2)
            ->increment('stok', 80);

        StokModel::where(function ($query) {
            $query->where('id_gudang', 1)
                ->where('id_produk', 1);
        })->orWhere(function ($query) {
            $query->where('id_gudang', 1)
                ->where('id_produk', 2);
        })->update(['updated_at' => now()]);
    }
}
