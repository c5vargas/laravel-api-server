<?php

namespace App\Http\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductSimpleTransformer extends TransformerAbstract
{
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
}
