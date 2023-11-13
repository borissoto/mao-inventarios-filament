<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('seasons')->insert(array(
                0 => array(
                    'id' => 1,
                    'name' => 'CARNAVALES',
                ),
                1 => array(
                    'id' => 2,
                    'name' => 'DIA DEL PADRE',
                ),
                2 => array(
                    'id' => 3,
                    'name' => 'DIA DE LA MADRE',
                ),
                3 => array(
                    'id' => 4,
                    'name' => 'DIA DEL MAESTRO',
                ),
                4 => array(
                    'id' => 5,
                    'name' => 'DIA AMISTAD',
                ),
                5 => array(
                    'id' => 6,
                    'name' => 'DIA AMISTAD',
                ),
                6 => array(
                    'id' => 7,
                    'name' => '21 SEPT',
                ),
                7 => array(
                    'id' => 8,
                    'name' => 'HALLOWEEN',
                ),
                8 => array(
                    'id' => 9,
                    'name' => 'NAVIDAD',
                ),
                9 => array(
                    'id' => 10,
                    'name' => 'AÑO NUEVO',
                ),

            )
        );
    }
}
