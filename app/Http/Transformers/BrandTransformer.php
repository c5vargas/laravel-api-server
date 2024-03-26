<?php

namespace App\Http\Transformers;

use App\Models\Brand;
use League\Fractal\TransformerAbstract;

class BrandTransformer extends TransformerAbstract
{
    public function transform(Brand $item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'image' => $item->image,
        ];
    }


}
