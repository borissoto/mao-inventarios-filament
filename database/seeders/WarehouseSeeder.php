<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('warehouses')->insert(array(
            0 => array(
                'id' => 1,
                'name' => 'ALMACEN 1',
                'location' => 'GALERIA BEIJING',
            ),
            1 => array(
                'id' => 2,
                'name' => 'ALMACEN 2',
                'location' => 'GALERIA BOMBAI',
            )
        )
        );
        
    }
}
