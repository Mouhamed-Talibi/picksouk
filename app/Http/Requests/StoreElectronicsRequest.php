<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreElectronicsRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:5',
                'max:50',
                'regex:/^[\p{Arabic}\p{Latin}0-9\s\-_,\.;:()\'\"]+$/u'
            ],
            'description_title' => [
                'required',
                'string',
                'min:15',
                'max:255',
                'regex:/^[\p{Arabic}\p{Latin}0-9\s\-_,\.;:()\'\"\؟!\،\ـ]+$/ux'
            ],
            'description' => [
                'required',
                'string',
                'min:50',
                'regex:/^[\p{Arabic}\p{Latin}0-9\s\-_,\.;:()\'\"\r\n]+$/u'
            ],
            'stock' => [
                'required',
                'integer',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'price' => [
                'required',
                'numeric',
                'min:1',
                'regex:/^[0-9]+(\.[0-9]{1,2})?$/'
            ],
            'old_price' => [
                'nullable',
                'numeric',
                'min:1',
                'regex:/^[0-9]+(\.[0-9]{1,2})?$/'
            ],
            'category_id' => [
                'required',
                'integer',
                'min:1',
                'exists:categories,id'
            ],
            'ram' => [
                'required',
                'integer',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'rom' => [
                'required',
                'integer',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'processor' => [
                'required',
                'string',
                'regex:/^[\p{Latin}0-9\s\-_,\.;:()\'\"]+$/u'
            ],
            'camera' => [
                'required',
                'string',
                'regex:/^[\p{Latin}0-9\s\-_,\.;:()\'\"MP]+$/ui'
            ],
            'weight' => [
                'required',
                'numeric',
                'regex:/^[0-9]+(\.[0-9]{1,2})?$/'
            ],
            'screen_size' => [
                'required',
                'string',
                'min:3',
                'regex:/^\d{1,3}\.\d$/'
            ],
            'brand' => [
                'required',
                'string',
                'min:3',
                'regex:/^[\p{Arabic}\p{Latin}\s\-_,\.;:\'\"]+$/u'
            ],
            'operating_system' => [
                'required',
                'string',
                'min:3',
                'in:android,ios,windows,linux'
            ],
            'images.*' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a string.',
            'name.min' => 'The product name must be at least 5 characters.',
            'name.max' => 'The product name may not be greater than 50 characters.',
            'name.regex' => 'The product name contains invalid characters. Only English, French, Arabic letters, numbers and basic punctuation are allowed.',
            
            'description_title.required' => 'The description title is required.',
            'description_title.string' => 'The description title must be a string.',
            'description_title.min' => 'The description title must be at least 15 characters.',
            'description_title.max' => 'The description title may not be greater than 255 characters.',
            'description_title.regex' => 'The description title contains invalid characters. Only English, French, Arabic letters, numbers and basic punctuation are allowed.',
            
            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',
            'description.min' => 'The description must be at least 50 characters.',
            'description.regex' => 'The description contains invalid characters.',
            
            'stock.required' => 'The stock quantity is required.',
            'stock.integer' => 'The stock must be an integer.',
            'stock.min' => 'The stock must be at least 1.',
            'stock.regex' => 'The stock must contain only numbers.',
            
            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be at least 1.',
            'price.regex' => 'The price must be a valid number with up to 2 decimal places.',
            
            'category_id.required' => 'The category is required.',
            'category_id.integer' => 'The category must be an integer.',
            'category_id.min' => 'The category ID must be at least 1.',
            'category_id.exists' => 'The selected category is invalid.',
            
            'ram.required' => 'The RAM specification is required.',
            'ram.integer' => 'The RAM must be an integer.',
            'ram.min' => 'The RAM must be at least 1.',
            'ram.regex' => 'The RAM must contain only numbers.',
            
            'rom.required' => 'The ROM specification is required.',
            'rom.integer' => 'The ROM must be an integer.',
            'rom.min' => 'The ROM must be at least 1.',
            'rom.regex' => 'The ROM must contain only numbers.',
            
            'processor.required' => 'The processor specification is required.',
            'processor.string' => 'The processor must be a string.',
            'processor.regex' => 'The processor contains invalid characters.',
            
            'camera.required' => 'The camera specification is required.',
            'camera.string' => 'The camera must be a string.',
            'camera.regex' => 'The camera contains invalid characters.',
            
            'weight.required' => 'The weight is required.',
            'weight.numeric' => 'The weight must be a number.',
            'weight.regex' => 'The weight must be a valid number with up to 2 decimal places.',
            
            'screen_size.required' => 'The screen size is required.',
            'screen_size.string' => 'The screen size must be a string.',
            'screen_size.min' => 'The screen size must be at least 3 characters.',
            'screen_size.regex' => 'The screen size contains invalid characters.',
            
            'brand.required' => 'The brand is required.',
            'brand.string' => 'The brand must be a string.',
            'brand.min' => 'The brand must be at least 3 characters.',
            'brand.regex' => 'The brand contains invalid characters. Only English, French, Arabic letters and basic punctuation are allowed.',
            
            'operating_system.required' => 'The operating system is required.',
            'operating_system.string' => 'The operating system must be a string.',
            'operating_system.min' => 'The operating system must be at least 3 characters.',
            'operating_system.in' => 'The selected operating system is invalid.',
            
            'images.*.required' => 'At least one image is required.',
            'images.*.image' => 'The file must be an image.',
            'images.*.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'images.*.max' => 'The image may not be greater than 2MB.',
        ];
    }
}
