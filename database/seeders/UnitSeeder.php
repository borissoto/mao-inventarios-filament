<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('units')->insert(array(
                0 => array(
                    'id' => 1,
                    'name' => 'CAJA',
                    'abbreviation' => 'CJ',
                ),
            )
        );
    }
}
