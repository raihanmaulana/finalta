<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // // Insert 'admin' role
        // DB::table('roles')->insert([
        //     'name' => 'admin',
        // ]);

        // Insert 'student' role
        DB::table('roles')->insert([
            'name' => 'anggota_perpustakaan',
        ]);
    }
}
