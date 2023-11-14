<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(SeasonSeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);
    }
}
