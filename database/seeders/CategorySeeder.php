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
        Category::create(['name' => 'Camisetas y Tops', 'featured' => true]);
        Category::create(['name' => 'Pantalones y Vaqueros', 'featured' => true]);
        Category::create(['name' => 'Calzado', 'featured' => true]);
        Category::create(['name' => 'Accesorios', 'featured' => true]);
        Category::create(['name' => 'Ropa Deportiva', 'featured' => true]);
        Category::create(['name' => 'Ropa Interior', 'featured' => true]);
        Category::create(['name' => 'Ropa de Abrigo', 'featured' => true]);
        Category::create(['name' => 'Vestidos y Faldas', 'featured' => true]);
        Category::create(['name' => 'Fiesta y Formal', 'featured' => true]);
        Category::create(['name' => 'Sneakers', 'featured' => true]);
    }
}
