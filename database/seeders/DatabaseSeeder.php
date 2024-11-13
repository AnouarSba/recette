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
        
$id=1;
        for ($i=1000; $i <= 25000 ; $i++) { 
            $c="Série A ".$i;
            
            DB::table('carnets')->insert([
                'name' => $c,
                'type' => 1,
                'status' => 1,
                
            ]);
            
            for ($j=1; $j <= 100 ; $j++) { 
                if ($j<10) {
                    $t='00'.$j;
                } elseif ($j<100) {
                    $t='0'.$j;
                }
                else $t = $j;
                DB::table('tickets')->insert([
                    'name' => 'ticket '.$i.' - '.$t,
                    'type' => 1,
                    'status' => 0,
                    'carnet_id' => $id,
                    
                ]);
    
            }
            $id++;
        }
        for ($i=1; $i <= 10000 ; $i++) { 
            
            $c="Série A ".$i;
            
            DB::table('carnets')->insert([
                'name' => $c,
                'type' => 2,
                'status' => 1,
                
            ]);
            for ($j=1; $j <= 100 ; $j++) { 
                if ($j<10) {
                    $t='00'.$j;
                } elseif ($j<100) {
                    $t='0'.$j;
                }
                else $t = $j;
                DB::table('tickets')->insert([
                    'name' => 'ticket '.$i.' - '.$t,
                    'type' => 2,
                    'status' => 0,
                    'carnet_id' => $id,
                    
                ]);
    
            }
            $id++;
        }
        for ($i=1; $i <= 5000 ; $i++) { 
            
            $c="Série A ".$i;
            
            DB::table('carnets')->insert([
                'name' => $c,
                'type' => 3,
                'status' => 1,
                
            ]);
            for ($j=1; $j <= 100 ; $j++) { 
                if ( $j<10) {
                    $t='00'.$j;
                } elseif ($j<100) {
                    $t='0'.$j;
                }
                else $t = $j;
                DB::table('tickets')->insert([
                    'name' => 'ticket '.$i.' - '.$t,
                    'type' => 3,
                    'status' => 0,
                    'carnet_id' => $id,
                    
                ]);
    
            }
            $id++;
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