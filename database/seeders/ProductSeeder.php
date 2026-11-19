<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Buket Bunga Mini',
                'description' => 'Buket bunga handmade dengan desain sederhana.',
                'price' => 75000,
                'stock' => 10,
                'category' => 'Buket',
                'created_at' => now(),
            ],
            [
                'name' => 'Tas Rajut Handmade',
                'description' => 'Tas rajut buatan tangan berbahan katun berkualitas.',
                'price' => 120000,
                'stock' => 5,
                'category' => 'Rajutan',
                'created_at' => now(),
            ],
        ]);
    }
}
