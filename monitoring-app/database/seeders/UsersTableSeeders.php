<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'rosali',
            'email'=>'rosali@gmail.com',
            'password'=>Hash::make('admin'),
            'role'=>'admin'
        ]);
        DB::table('users')->insert([
            'name'=>'selpira',
            'email'=>'selpira@gmail.com',
            'password'=>Hash::make('pengguna'),
            'role'=>'pengguna'
        ]);
        DB::table('users')->insert([
            'name'=>'dzahira',
            'email'=>'dzahira@gmail.com',
            'password'=>Hash::make('pengguna'),
            'role'=>'pengguna'
        ]);
    }
}
