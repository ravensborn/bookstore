<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        $canViewReports = Permission::create(['name' => 'view reports', 'guard_name' => 'api']);

        $canViewReports->assignRole($adminRole);

        $devUser = User::factory()->create([
            'name' => 'Dev User',
            'email' => 'test@example.com',
        ]);


        $devUser->assignRole([$adminRole]);

        $normalUser = User::factory()->create([
            'name' => 'Normal User',
            'email' => 'normal@example.com',
        ]);

        Category::factory(3)->create();
        Book::factory(5)->create();

    }
}
