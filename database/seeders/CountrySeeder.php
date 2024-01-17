<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('countries')->insert(array(
                0 => array(
                    'id' => 1,
                    'name' => 'China',
                    'abbreviation' => 'CH',
                ),
                1 => array(
                    'id' => 2,
                    'name' => 'Peru',
                    'abbreviation' => 'PE',
                ),
                2 => array(
                    'id' => 3,
                    'name' => 'Colombia',
                    'abbreviation' => 'CO',
                ),
                3 => array(
                    'id' => 4,
                    'name' => 'Bolivia',
                    'abbreviation' => 'BO',
                )
            )
    )   ;
    }
}
