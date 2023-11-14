<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert(array(
            0 => array(
                'id' => 1,
                'name' => 'JUGUETES',
                'description' => 'TODO TIPO DE JUGUETES',
            ),
            1 => array(
                'id' => 2,
                'name' => 'COTILLON',
                'description' => 'TODO TIPO DE COTILLON',
            )
        )
    );
    }
}
