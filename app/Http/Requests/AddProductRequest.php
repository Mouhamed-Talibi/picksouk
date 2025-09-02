<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddProductRequest extends FormRequest
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
                'unique:products,name',
                'regex:/^[\p{Arabic}\p{L}0-9\s_\-?]+$/u'
            ],
            'description' => [
                'required',
                'string',
                'max:2000',
                'regex:/^[\p{Arabic}\p{L}0-9\s\-.,;:!?"\'()\/@#$%&*+=_<>«»،؛؟ء\p{So}\p{Sc}]+$/u'
            ],
            'price' => [
                'required',
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
            'images' => [ // Changed from 'image' to 'images' (array)
            'required',
            'array',
            'min:3',
            'max:5'
            ],
            'images.*' => [ // Validation for each image
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:2048'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'حقل اسم المنتج مطلوب',
            'name.regex' => 'يجب أن يحتوي اسم المنتج على أحرف عربية/إنجليزية فقط مع المسافات',
            'description.required' => 'حقل الوصف مطلوب',
            'description.regex' => 'يحتوي الوصف على أحرف غير مسموحة. يُسمح فقط بالأحرف العربية/الإنجليزية، الأرقام وعلامات الترقيم الأساسية',
            'price.required' => 'حقل السعر مطلوب',
            'price.regex' => 'يجب أن يكون السعر رقمًا صحيحًا أو عشريًا بخانتين كحد أقصى',
            'price.min' => 'يجب أن يكون السعر أكبر من أو يساوي 0.01',
            'stock.required' => 'حقل الكمية المتاحة مطلوب',
            'stock.integer' => 'يجب أن تكون الكمية رقماً صحيحاً',
            'stock.min' => 'يجب أن تكون الكمية أكبر من أو تساوي الصفر',
            'image.required' => 'صورة المنتج مطلوبة',
            'image.image' => 'يجب أن يكون الملف صورة',
            'image.mimes' => 'يجب أن تكون الصورة من نوع: jpeg, png, jpg, gif, webp',
            'image.max' => 'يجب ألا تتجاوز الصورة 2 ميجابايت',
            'category.required' => 'حقل الفئة مطلوب',
            'category.integer' => 'يجب اختيار فئة صحيحة',
            'category.min' => 'يجب اختيار فئة صحيحة',
            'images.required' => 'حقل الصور مطلوب',
            'images.array' => 'يجب رفع الصور بشكل صحيح',
            'images.min' => 'يجب رفع 3 صور على الأقل',
            'images.max' => 'يجب ألا تزيد الصور عن 5 صور',
            'images.*.image' => 'يجب أن يكون الملف صورة',
            'images.*.mimes' => 'يجب أن تكون الصورة من نوع: jpeg, png, jpg, gif, webp',
            'images.*.max' => 'يجب ألا تتجاوز الصورة 2 ميجابايت'
        ];
    }
}