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
        DB::table('seasons')->insert(
            [
                'id' => 1,
                'name' => 'CARNAVALES',
            ],
            [
                'id' => 2,
                'name' => 'DIA PADRE',
            ],
            [
                'id' => 3,
                'name' => 'DIA MADRE',
            ],
            [
                'id' => 4,
                'name' => 'DIA MAESTRO',
            ],
            [
                'id' => 5,
                'name' => 'DIA NIÑO',
            ],
            [
                'id' => 6,
                'name' => 'DIA AMISTAD',
            ],
            [
                'id' => 7,
                'name' => '21 SEPT',
            ],
            [
                'id' => 8,
                'name' => 'HALLOWEEN',
            ],
            [
                'id' => 9,
                'name' => 'NAVIDAD',
            ],
            [
                'id' => 10,
                'name' => 'AÑO NUEVO',
            ],
            
        );
    }
}
