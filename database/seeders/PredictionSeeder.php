<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PredictionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('predictions')->insert([
            'location'  =>  'EDSA Shaw',
            'direction' =>  'NB',
            'total_accidents'   =>  20,
            'accident_prediction'   =>  rand(20,100)
        ]);
        DB::table('predictions')->insert([
            'location'  =>  'EDSA Balintawak',
            'direction' =>  'NB',
            'total_accidents'   =>  20,
            'accident_prediction'   =>  rand(20,100)
        ]);
        DB::table('predictions')->insert([
            'location'  =>  'EDSA Kamuning',
            'direction' =>  'NB',
            'total_accidents'   =>  20,
            'accident_prediction'   =>  rand(20,100)
        ]);
        DB::table('predictions')->insert([
            'location'  =>  'EDSA Guadalupe',
            'direction' =>  'NB',
            'total_accidents'   =>  20,
            'accident_prediction'   =>  rand(20,100)
        ]);
    }
}
