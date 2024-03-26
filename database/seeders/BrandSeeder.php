<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create(['name' => 'Nike', 'image' => 'demo/brands/nike.webp']);
        Brand::create(['name' => 'Chanel', 'image' => 'demo/brands/chanel.webp']);
        Brand::create(['name' => 'Zara', 'image' => 'demo/brands/zara.webp']);
        Brand::create(['name' => 'Adidas', 'image' => 'demo/brands/adidas.webp']);
        Brand::create(['name' => 'Decathlon', 'image' => 'demo/brands/nike.webp']);
        Brand::create(['name' => 'Gucci', 'image' => 'demo/brands/nike.webp']);
        Brand::create(['name' => 'Mango', 'image' => 'demo/brands/nike.webp']);
        Brand::create(['name' => 'Shein', 'image' => 'demo/brands/nike.webp']);
        Brand::create(['name' => 'Louis Vuitton', 'image' => 'demo/brands/nike.webp']);
        Brand::create(['name' => 'The North Face', 'image' => 'demo/brands/nike.webp']);
        Brand::create(['name' => 'Supreme', 'image' => 'demo/brands/nike.webp']);
        Brand::create(['name' => 'Balenciaga', 'image' => 'demo/brands/nike.webp']);
        Brand::create(['name' => 'Versace', 'image' => 'demo/brands/nike.webp']);
        Brand::create(['name' => 'Off-White', 'image' => 'demo/brands/nike.webp']);
        Brand::create(['name' => 'Burberry', 'image' => 'demo/brands/nike.webp']);
    }
}
