<?php

namespace App\Http\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = ['products'];


    public function transform(Category $item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'image' => $item->image,
        ];
    }

    public function includeProducts(Category $item)
    {
        return $this->collection($item->products, new ProductSimpleTransformer());
    }


}
