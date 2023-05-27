<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PredictionColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prediction_colors')->insert([
            'from'  =>  10,
            'to'    =>  30,
            'text'  =>  'gray-500',
            'background'    => 'lime-500'
        ]);

        DB::table('prediction_colors')->insert([
            'from'  =>  31,
            'to'    =>  55,
            'text'  =>  'gray-500',
            'background'    => 'yellow-500'
        ]);

        DB::table('prediction_colors')->insert([
            'from'  =>  56,
            'to'    =>  70,
            'text'  =>  'gray-500',
            'background'    => 'orange-300'
        ]);

        DB::table('prediction_colors')->insert([
            'from'  =>  71,
            'to'    =>  85,
            'text'  =>  'gray-500',
            'background'    => 'yellow-500'
        ]);

        DB::table('prediction_colors')->insert([
            'from'  =>  86,
            'to'    =>  100,
            'text'  =>  'gray-500',
            'background'    => 'red-500'
        ]);
    }
}
