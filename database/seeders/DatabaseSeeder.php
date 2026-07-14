<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_id' => '1',
            'socialMedia' => '@admin',
            'address' => 'Jakarta',
            'country' => 'ID',
            'postalCode' => '12345',
            'phoneNumber' => '081100000001',
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_id' => '2',
            'socialMedia' => '@testuser',
            'address' => 'Bandung',
            'country' => 'ID',
            'postalCode' => '54321',
            'phoneNumber' => '081100000002',
        ]);

        $products = [
            ['category' => 'print', 'productName' => 'Renheng Artwork', 'description' => "It's about Renheng", 'price' => 150000, 'photo' => 'photos/seed_101.jpg'],
            ['category' => 'print', 'productName' => 'Luxiem Artwork', 'description' => 'Luxiem Artwork', 'price' => 175000, 'photo' => 'photos/seed_102.jpg'],
            ['category' => 'photocard', 'productName' => 'Komi Photocard', 'description' => 'Komi photocard set', 'price' => 25000, 'photo' => 'photos/seed_103.jpg'],
            ['category' => 'photocard', 'productName' => 'Tadano Photocard', 'description' => 'Tadano photocard set', 'price' => 25000, 'photo' => 'photos/seed_104.jpg'],
            ['category' => 'charms', 'productName' => 'Sakura Charm', 'description' => 'Handmade acrylic charm', 'price' => 45000, 'photo' => 'photos/seed_105.jpg'],
            ['category' => 'artbook', 'productName' => 'Fanart Collection Vol. 1', 'description' => 'A collection of original fanart', 'price' => 220000, 'photo' => 'photos/seed_106.jpg'],
        ];

        foreach ($products as $product) {
            Product::create([
                'category' => $product['category'],
                'productName' => $product['productName'],
                'description' => $product['description'],
                'price' => $product['price'],
                'photo' => $product['photo'],
                'photoPreview' => [$product['photo']],
                'photoProgress' => [$product['photo']],
            ]);
        }
    }
}
