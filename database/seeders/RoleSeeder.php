<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role1 = Role::create(['name'=>'SuperAdmin', 'guard_name'=>'web']);
        $role2 = Role::create(['name'=>'Administrador', 'guard_name'=>'web']);
        $role3 = Role::create(['name'=>'Vendedor', 'guard_name'=>'web']);
    }
}
