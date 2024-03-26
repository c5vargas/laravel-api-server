<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\Api\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //todo auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'         => 'required|string',
            'description'   => 'required|string',
            'image'         => 'required|file|max:2024|mimes:jpg,bmp,png', //max 2024 kb
            'colors'        => 'nullable|sometimes|string',
            'categories'    => 'required|string',
            'shop_link'     => 'required|url:http,https',
            'brand_id'      => 'required|exists:brands,id',
        ];
    }
}
