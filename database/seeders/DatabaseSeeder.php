<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        if (DB::table('roles')->count() == 0) {
            DB::table('roles')->insert([
                [
                    'name' => 'Elève',
                    'rights_lvl' => 1,
                ],
                [
                    'name' => 'Intervenant',
                    'rights_lvl' => 2,
                ],
                [
                    'name' => 'Admin',
                    'rights_lvl' => 3,
                ],
            ]);
        }
        if (DB::table('users')->count() == 0) {
            DB::table('users')->insert([
                'firstname' => 'Brice',
                'lastname' => 'Eliasse',
                'password' => Hash::make('tira'),
                'email' => 'brice.eliasse@gmail.com',
                'role_id' => 3,
                'avatar' => 'https://robohash.org/briceeliasse.png'
            ]);
        }
    }
}
