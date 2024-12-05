<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'id' => 1,
            'name' => 'Milenka',
            'email' => 'admin@maobol.com',
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
            'status' => 1,
        ])->assignRole('SuperAdmin');
    }
}
