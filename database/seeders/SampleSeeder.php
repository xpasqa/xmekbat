<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sample')->insert([
            [
                'name' => 'Physical Properties',
                'price_rates' => 100000,
                'sample_rates' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'Ultrasonic Velocity',
                'price_rates' => 100000,
                'sample_rates' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'Uniaxial Compressive Strength',
                'price_rates' => 330000,
                'sample_rates' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'Direct Shear',
                'price_rates' => 600000,
                'sample_rates' => 3,
                'created_at' => now()
            ],
            [
                'name' => 'Direct Shear',
                'price_rates' => 500000,
                'sample_rates' => 5,
                'created_at' => now()
            ],
            [
                'name' => 'Direct Shear',
                'price_rates' => 500000,
                'sample_rates' => 5,
                'created_at' => now()
            ],
        ]);
    }
}
