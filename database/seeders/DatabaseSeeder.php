<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1 Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@toystore.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 1 Customer user
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@toystore.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // 5 Categories
        $categories = [
            ['name' => 'Action Figures', 'description' => 'Cool action figures'],
            ['name' => 'Board Games', 'description' => 'Fun for the family'],
            ['name' => 'Puzzles', 'description' => 'Brain teasers'],
            ['name' => 'Dolls', 'description' => 'Dolls and accessories'],
            ['name' => 'Educational', 'description' => 'Learn while playing'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // 10 Products
        $products = [
            ['name' => 'Superhero Figure', 'description' => 'Plastic superhero', 'price' => 19.99, 'stock' => 50, 'category_id' => 1],
            ['name' => 'Villain Figure', 'description' => 'Plastic villain', 'price' => 18.99, 'stock' => 30, 'category_id' => 1],
            ['name' => 'Monopoly', 'description' => 'Classic property game', 'price' => 29.99, 'stock' => 20, 'category_id' => 2],
            ['name' => 'Chess Set', 'description' => 'Wooden chess set', 'price' => 24.99, 'stock' => 15, 'category_id' => 2],
            ['name' => '1000pc Landscape', 'description' => 'Beautiful landscape puzzle', 'price' => 14.99, 'stock' => 40, 'category_id' => 3],
            ['name' => '500pc Animals', 'description' => 'Animal kingdom puzzle', 'price' => 9.99, 'stock' => 60, 'category_id' => 3],
            ['name' => 'Fashion Doll', 'description' => 'Doll with outfits', 'price' => 22.99, 'stock' => 35, 'category_id' => 4],
            ['name' => 'Baby Doll', 'description' => 'Interactive baby doll', 'price' => 25.99, 'stock' => 25, 'category_id' => 4],
            ['name' => 'Alphabet Blocks', 'description' => 'Wooden blocks for learning', 'price' => 12.99, 'stock' => 100, 'category_id' => 5],
            ['name' => 'Science Kit', 'description' => 'Basic chemistry set', 'price' => 34.99, 'stock' => 10, 'category_id' => 5],
        ];

        foreach ($products as $prod) {
            Product::create($prod);
        }
    }
}
