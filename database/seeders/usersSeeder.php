<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->truncate();

        DB::table('users')->insert([
            [
                'id_hak' => 1,
                'username' => '1',
                'password' => bcrypt(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_hak' => 2,
                'username' => '2',
                'password' => bcrypt(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_hak' => 3,
                'username' => '3',
                'password' => bcrypt(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
