<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'feature'  =>  'google_map_api',
            'is_active' =>  0,
        ]);

        DB::table('settings')->insert([
            'feature'  =>  'taps_api',
            'is_active' =>  0,
        ]);

    }
}
