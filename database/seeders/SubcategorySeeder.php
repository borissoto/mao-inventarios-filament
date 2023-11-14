<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('subcategories')->insert(array(
            0 => array(
                'id' => 1,
                'category_id' => 1,
                'name' => 'DIDACTICOS',
                'description' => 'TODO TIPO DE JUGUETES DIDACTICOS',
            ),
            1 => array(
                'id' => 2,
                'category_id' => 1,
                'name' => 'MUÑECAS',
                'description' => 'TODO TIPO DE MUÑECAS',
            ),
            2 => array(
                'id' => 3,
                'category_id' => 1,
                'name' => 'AUTOS',
                'description' => 'TODO TIPO DE AUTOS',
            )
        )
    );
    }
}
