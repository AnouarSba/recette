<?php

namespace Database\Seeders;

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
            'username' => 'DG',
            'firstname' => 'DG',
            'lastname' => 'DG',
            'email' => 'DG@admin.com',
            'password' => bcrypt('secret')
        ]);
        DB::table('users')->insert([
            'username' => 'statistique',
            'firstname' => 'Stat',
            'lastname' => 'Stat',
            'email' => 'CHEF@admin.com',
            'password' => bcrypt('password')
        ]);

        DB::table('users')->insert([
            'username' => 'CP',
            'firstname' => 'Caisse',
            'lastname' => 'principal',
            'email' => 'caissep@gmail.com',
            'password' => bcrypt('pr-caisse2023')
        ]);
        DB::table('users')->insert([
            'username' => 'Caisse',
            'firstname' => 'Caisse',
            'lastname' => 'Caisse',
            'email' => 'caisse@gmail.com',
            'password' => bcrypt('caisse2023')
        ]);



        $this->call(Arrets::class);
        $this->call(Lignes::class);
        $this->call(Buses::class);
        $this->call(Kabids::class);
    }
}