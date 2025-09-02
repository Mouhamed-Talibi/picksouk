<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->role === "admin";
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[\p{Arabic}\p{L}0-9\s_\-?]+$/u'
            ],
            'description' => [
                'required',
                'string',
                'max:2000',
                'regex:/^[\p{Arabic}\p{L}0-9\s_\-?]+$/u'
            ],
            'price' => [
                'required',
                'numeric',
                'min:0.01',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'old_price' => [
                'nullable',
                'numeric',
                'min:0.01',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'stock' => [
                'required',
                'integer',
                'min:0'
            ],
            'category' => [
                'required',
                'integer',
                'min:0'
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:2048'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The product name field is required',
            'name.regex' => 'Product name must contain only English/Arabic characters and spaces',
            'description.required' => 'The description field is required',
            'description.regex' => 'Description contains invalid characters. Only English/Arabic characters, numbers, and basic punctuation are allowed',
            'price.required' => 'The price field is required',
            'price.regex' => 'Price must be a valid number with up to 2 decimal places',
            'price.min' => 'Price must be greater than or equal to 0.01',
            'stock.required' => 'The stock quantity field is required',
            'stock.integer' => 'Stock quantity must be a whole number',
            'stock.min' => 'Stock quantity must be greater than or equal to zero',
            'image.required' => 'Product image is required',
            'image.image' => 'The file must be an image',
            'image.mimes' => 'The image must be of type: jpeg, png, jpg, gif, or webp',
            'image.max' => 'The image must not exceed 2MB',
            'category.required' => 'The category field is required',
            'category.integer' => 'Please select a valid category',
            'category.min' => 'Please select a valid category'
        ];
    }
}