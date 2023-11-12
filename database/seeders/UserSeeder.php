<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@mao.com',
            'password' => Hash::make('123456'),
            'forename' => 'Mile',
            'p_surname' => 'ApPaterno',
            'm_surname' => 'ApMaterno',
            'id_number' => '22333445',
            'sex' => 'FEMENINO',
            'birthdate' => '1990-06-06 00:00:00',
            'mobile' => '77712345',
            'address' => 'Direccion domicilio',
            'start' => '2023-01-01 00:00:00',
            'state' => 1,
        ]);
    }
}
