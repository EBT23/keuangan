<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'DOhle',
            'email' => 'dohle@example.com',
            'password' => bcrypt('12345678'),
            'no_identitas' => '756764875',
            'tempat_lahir' => 'kebumen',
            'tgl_lahir' => '2022-08-08',
            'no_rek' => '762876282',
            'role_id' => '2',
            'posisi_id' => '6',
            'status' => 'null',
            'no_tlp' => '089764534253',
            'created_at' => now(),
        ]);
    }
}