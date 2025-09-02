<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessagesRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:100',
                'regex:/^[\p{Arabic}a-zA-ZÀ-ÖØ-öø-ÿ\s\'-]+$/u',
            ],
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:150',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,}$/',
            ],
            'message' => [
                'required',
                'string',
                'min:10',
                'max:1000',
                'regex:/^[\p{Arabic}a-zA-Z0-9À-ÖØ-öø-ÿ\s\n.,!?()@\'"%-_+=:;\/\[\]{}&$#*]*$/u',
            ],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب.',
            'name.max' => 'يجب ألا يتجاوز الاسم 100 حرف.',
            'name.regex' => 'الاسم يجب أن يحتوي فقط على أحرف عربية أو لاتينية ومسافات وعلامات بسيطة.',

            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'الرجاء إدخال بريد إلكتروني صالح.',
            'email.max' => 'البريد الإلكتروني طويل جدًا.',
            'email.regex' => 'صيغة البريد الإلكتروني غير صحيحة.',

            'message.required' => 'الرسالة مطلوبة.',
            'message.min' => 'الرسالة يجب أن تحتوي على 10 أحرف على الأقل.',
            'message.max' => 'الرسالة يجب ألا تتجاوز 1000 حرف.',
            'message.regex' => 'الرسالة تحتوي على رموز غير مسموح بها.',
        ];
    }
}
