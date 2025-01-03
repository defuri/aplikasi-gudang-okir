<?php

namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::truncate();

        $this->call([
            hakSeeder::class,
            usersSeeder::class,
            suplier::class,
            bahan_baku::class,
            satuan::class,
            transaksi_bahan_baku::class,
            rasa::class,
            kategori::class,
            pack::class,
            produk::class,
            gudang::class,
            stok::class,
            ProdukMasukSeeder::class,
            ProdukKeluarSeeder::class,
            DetailTransaksiBahanBakuSeeder::class,
        ]);
    }
}
