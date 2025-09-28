<?php

namespace Database\Seeders;

use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // $users = User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => Hash::make('12345')
        // ]);

        $categories = Category::factory()->count(3)->create();
        $products = Product::factory()->count(10)->create();


    }
}
