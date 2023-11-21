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
            'username' => 'Caisse_M',
            'firstname' => 'Caisse',
            'lastname' => 'Caisse',
            'email' => 'caisseM@gmail.com',
            'password' => bcrypt('caisse2023123')
        ]);
        DB::table('users')->insert([
            'username' => 'Caisse_N',
            'firstname' => 'Caisse',
            'lastname' => 'Caisse',
            'email' => 'caisseN@gmail.com',
            'password' => bcrypt('caisse2023258')
        ]);
        DB::table('users')->insert([
            'username' => 'Caisse_D',
            'firstname' => 'Caisse',
            'lastname' => 'Caisse',
            'email' => 'caisseD@gmail.com',
            'password' => bcrypt('caisse2023357')
        ]);



        $this->call(Arrets::class);
        $this->call(Lignes::class);
        $this->call(Buses::class);
        $this->call(Kabids::class);
        

        for ($i=1; $i <= 100 ; $i++) { 
            $c=$i-1;
            $begin=$c.'01';
            $end=$i."00";
            $c="Série ".$c."01-".$i."00";
            
            DB::table('carnets')->insert([
                'name' => $c,
                'type' => 1,
                'status' => 1,
                
            ]);
            for ($j=$begin; $j <= $end ; $j++) { 
                if ($j>=2 && $j<10) {
                    $t='00'.$j;
                } elseif ($j<100) {
                    $t='0'.$j;
                }
                else $t = $j;
                DB::table('tickets')->insert([
                    'name' => 'ticket '.$t,
                    'type' => 2,
                    'status' => 0,
                    'carnet_id' => $i,
                    
                ]);
    
            }
        }
        for ($i=101; $i <= 200 ; $i++) { 
            $c=$i-1;
            $begin=$c.'01';
            $end=$i."00";
            $c="Série ".$c."01-".$i."00";
            
            DB::table('carnets')->insert([
                'name' => $c,
                'type' => 2,
                'status' => 1,
                
            ]);
            for ($j=$begin; $j <= $end ; $j++) { 
                if ($j>=2 && $j<10) {
                    $t='00'.$j;
                } elseif ($j<100) {
                    $t='0'.$j;
                }
                else $t = $j;
                DB::table('tickets')->insert([
                    'name' => 'ticket '.$t,
                    'type' => 2,
                    'status' => 0,
                    'carnet_id' => $i,
                    
                ]);
    
            }
        }
        for ($i=201; $i <= 300 ; $i++) { 
            $c=$i-1;
            $begin=$c.'01';
            $end=$i."00";
            $c="Série ".$c."01-".$i."00";
            
            DB::table('carnets')->insert([
                'name' => $c,
                'type' => 3,
                'status' => 1,
                
            ]);
            for ($j=$begin; $j <= $end ; $j++) { 
                if ($j>=2 && $j<10) {
                    $t='00'.$j;
                } elseif ($j<100) {
                    $t='0'.$j;
                }
                else $t = $j;
                DB::table('tickets')->insert([
                    'name' => 'ticket '.$t,
                    'type' => 3,
                    'status' => 0,
                    'carnet_id' => $i,
                    
                ]);
    
            }
        }
     /* 
     for ($i=101; $i <= 150 ; $i++) { 
            DB::table('carnets')->insert([
                'name' => 't'.$i,
                'type' => 2,
                'status' => rand(0, 10),
                
            ]);
            for ($j=1; $j <= 100 ; $j++) { 
                DB::table('tickets')->insert([
                    'name' => 'c'.$j,
                    'type' => 2,
                    'status' => 0,
                    'carnet_id' => $i,
                    
                ]);
    
            }
        }
     */
    }
}