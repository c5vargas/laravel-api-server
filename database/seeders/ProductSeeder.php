<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = Brand::all();
        $categories = Category::all();

        Product::factory()
            ->state(new Sequence(
                fn () => [
                    'brand_id' => $brands->random()->id,
                ]
            ))
            ->count(200)
            ->createQuietly();

        Product::each(function ($product) use ($categories) {
            $product->categories()->attach(
                $categories->random(rand(1,3))->pluck('id')->toArray()
            );
        });
    }

}
