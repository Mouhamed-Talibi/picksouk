<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreBagsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->role === "admin";
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Product fields
            'name' => [
                'required',
                'string',
                'min:4',
                'max:255',
                'regex:/^[\p{Arabic}A-Za-z0-9\s,]+$/u'
            ],
            'description_title' => [
                'required',
                'string',
                'min:10',
                'max:255',
                'regex:/^[\p{Arabic}A-Za-z0-9\s,._-]+$/u'
            ],
            'description' => [
                'required',
                'string',
                'min:20',
                'regex:/^[\p{Arabic}A-Za-z0-9\s,._-]+$/u'
            ],
            'stock' => [
                'required',
                'integer',
                'min:0'
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'old_price' => [
                'nullable',
                'numeric',
                'min:0',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id'
            ],
            
            // Bag specific fields
            'brand' => [
                'required',
                'string',
                'max:100',
                'regex:/^[\p{Arabic}a-zA-Z0-9\s\-\.&\(\)\p{L}]+$/u'
            ],
            'weight' => [
                'required',
                'numeric',
                'between:0.01,999999.99',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'external_material' => [
                'required',
                'string',
                'max:50',
                'regex:/^[\p{Arabic}a-zA-Z\s\-\/\(\)\p{L}]+$/u'
            ],
            'color' => [
                'nullable',
                'string',
                'max:30',
                'regex:/^[\p{Arabic}a-zA-Z\s\-\#\(\)]+$/u'
            ],
            'size' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[\p{Arabic}a-zA-Z0-9\s\-\.\x{00D7}\:\،\;\,\/\(\)\%\!\?\+\=\&]+$/u'
            ],
            'images.*' => [
                'required',
                'image',
                'mimes:png,jpg,jpeg',
                'max:2048'
            ],
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            // Product fields messages
            'name.required' => 'Product name is required.',
            'name.min' => 'Product name must be at least 4 characters.',
            'name.regex' => 'Product name contains invalid characters.',
            
            'description_title.required' => 'Description title is required.',
            'description_title.min' => 'Description title must be at least 10 characters.',
            
            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least 20 characters.',
            
            'stock.required' => 'Stock quantity is required.',
            'stock.integer' => 'Stock must be a whole number.',
            'stock.min' => 'Stock cannot be negative.',
            
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a valid number.',
            'price.min' => 'Price cannot be negative.',
            
            'old_price.numeric' => 'Old price must be a valid number.',
            'old_price.min' => 'Old price cannot be negative.',
            
            'category_id.required' => 'Category selection is required.',
            'category_id.exists' => 'Selected category does not exist.',
            
            // Bag fields messages
            'brand.required' => 'Brand name is required.',
            'brand.regex' => 'Brand name contains invalid characters.',
            
            'weight.required' => 'Weight is required.',
            'weight.numeric' => 'Weight must be a valid number.',
            'weight.between' => 'Weight must be between 0.01 and 999999.99.',
            
            'external_material.required' => 'External material is required.',
            'external_material.regex' => 'External material contains invalid characters.',
            
            'color.regex' => 'Color contains invalid characters.',
            
            'size.regex' => 'Size contains invalid characters.',
            
            'images.*.required' => 'At least one image is required.',
            'images.*.image' => 'The file must be a valid image.',
            'images.*.mimes' => 'The image must be a PNG, JPG, or JPEG file.',
            'images.*.max' => 'The image may not be larger than 2MB.',
        ];
    }
}