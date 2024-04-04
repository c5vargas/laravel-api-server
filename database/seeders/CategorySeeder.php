<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['slug' => 'camisetas-y-tops', 'name' => 'Camisetas y Tops', 'featured' => true]);
        Category::create(['slug' => 'pantalones-y-vaqueros', 'name' => 'Pantalones y Vaqueros', 'featured' => true]);
        Category::create(['slug' => 'calzado', 'name' => 'Calzado', 'featured' => true]);
        Category::create(['slug' => 'accesorios', 'name' => 'Accesorios', 'featured' => true]);
        Category::create(['slug' => 'ropa-deportiva', 'name' => 'Ropa Deportiva', 'featured' => true]);
        Category::create(['slug' => 'ropa-interior', 'name' => 'Ropa Interior', 'featured' => true]);
        Category::create(['slug' => 'ropa-de-abrigo', 'name' => 'Ropa de Abrigo', 'featured' => true]);
        Category::create(['slug' => 'vestidos-y-faldas', 'name' => 'Vestidos y Faldas', 'featured' => true]);
        Category::create(['slug' => 'fiesta-y-formal', 'name' => 'Fiesta y Formal', 'featured' => true]);
        Category::create(['slug' => 'sneakers', 'name' => 'Sneakers', 'featured' => true]);
    }
}
