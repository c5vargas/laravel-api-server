<?php
namespace App\Repositories\Eloquent;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductRepository extends BaseRepository
{
    protected $model;

    /**
     * ProductRepository constructor.
     *
     * @param Product $user
     */
    public function __construct(Product $item)
    {
        $this->model = $item;
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function random()
    {
        return $this->model->inRandomOrder()->take(10)->get();
    }

    public function create($payload): Product
    {
        $payload['slug'] = Str::slug($payload['title'], "-");
        $imageName = time().'.'.$payload['image']->extension();

        $payload['image']->storeAs('public/products', $imageName);
        $payload['image'] = "storage/products/{$imageName}";

        $categories = explode(',', $payload['categories']);
        $product = $this->model->create($payload);

        $product->categories()->attach($categories);
        return $product;
    }

    public function search($query)
    {
        return $this->model->where('title', 'like', "%{$query}%")->get();
    }
}
