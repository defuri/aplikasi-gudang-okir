<?php

namespace Database\Seeders;

use App\Models\Pengiriman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PengirimanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        Pengiriman::truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('pengiriman')->insert([
            [
                'pesanan_id' => 3,
                'tanggal' => date(now()),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pesanan_id' => 4,
                'tanggal' => date(now()),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
