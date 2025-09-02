<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => [
                'required',
                'string',
                'max:100',
                // allow only chars and spaces
                'regex:/^[\p{Arabic}a-zA-Z\s]+$/u'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:150'
            ],
            'rating' => [
                'required',
                'integer',
                'between:1,5'
            ],
            'comment' => [
                'required',
                'string',
                'max:500',
                // allow only ar, fr, and basic symbols
                'regex:/^[\p{Arabic}a-zA-Z0-9\s.,!?_\-]+$/u'
            ],
        ];
    }

    /**
     * Custom error messages in Arabic.
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'الاسم الكامل مطلوب.',
            'full_name.regex' => 'الاسم يجب أن يحتوي على أحرف ومسافات فقط.',
            'full_name.max' => 'الاسم الكامل يجب ألا يتجاوز 100 حرف.',

            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'الرجاء إدخال بريد إلكتروني صالح.',
            'email.max' => 'البريد الإلكتروني يجب ألا يتجاوز 150 حرف.',

            'rating.required' => 'الرجاء اختيار التقييم.',
            'rating.integer' => 'التقييم يجب أن يكون رقم صحيح.',
            'rating.between' => 'التقييم يجب أن يكون بين 1 و 5.',

            'comment.required' => 'التعليق مطلوب.',
            'comment.regex' => 'التعليق يحتوي على رموز غير مسموحة.',
            'comment.max' => 'التعليق يجب ألا يتجاوز 500 حرف.',
        ];
    }
}
