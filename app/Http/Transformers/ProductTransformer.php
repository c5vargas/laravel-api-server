<?php

namespace App\Http\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = ['brand', 'categories'];

    public function transform(Product $item)
    {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'slug' => $item->slug,
            'description' => $item->description,
            'colors' => $item->colors,
            'keywords' => $item->keywords,
            'image' => $item->image,
            'shop_link' => $item->shop_link,
        ];
    }

    public function includeBrand(Product $item)
    {
        return $this->item($item->brand, new BrandTransformer());
    }

    public function includeCategories(Product $item)
    {
        return $this->collection($item->categories, new CategoryTransformer());
    }
}
