<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FindProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && in_array(Auth::user()->role, ['admin', 'user']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search_text' => [
                'required',
                'string',
                'min:3',
                'regex:/^[\p{Arabic}a-zA-Z0-9\s]+$/u'
            ],
        ];
    }

    // messages 
    public function messages(): array
    {
        return [
            'search_text.required' => 'حقل البحث مطلوب.',
            'search_text.string'   => 'يجب أن يكون البحث نصاً صحيحاً.',
            'search_text.min'      => 'يجب أن يحتوي البحث على 3 أحرف على الأقل.',
            'search_text.regex'    => 'يحتوي البحث على رموز غير مسموح بها، استخدم الحروف والأرقام فقط.',
        ];
    }
}
