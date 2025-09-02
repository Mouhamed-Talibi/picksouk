<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
                'exists:users,email'
            ],
            'password' => [
                'required',
                'string',
                'min:8'
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'بيانات الاعتماد المقدمة غير مطابقة لسجلاتنا.',
            'email.required' => 'يرجى إدخال عنوان بريدك الإلكتروني.',
            'password.required' => 'يرجى إدخال كلمة المرور الخاصة بك.',
        ];
    }
}