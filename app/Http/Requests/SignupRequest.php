<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignupRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user)
            ],
            'gender' => [
                'required',
                Rule::in(['male', 'female'])
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:50',
                'confirmed',
                'regex:/^[\w!@#$%^&*()\-_=+{};:,<.>]+$/'
            ]
        ];
    }

    public function messages()
    {
        return [
            // name
            'name.required' => 'يرجى إدخال الاسم.',
            'name.string' => 'يجب أن يكون الاسم نصًا.',
            'name.min' => 'يجب أن يحتوي الاسم على 3 أحرف على الأقل.',
            'name.max' => 'يجب ألا يتجاوز الاسم 50 حرفًا.',
            'name.regex' => 'يجب أن يحتوي الاسم على حروف ومسافات فقط.',

            // email
            'email.required' => 'يرجى إدخال عنوان البريد الإلكتروني.',
            'email.email' => 'يرجى إدخال عنوان بريد إلكتروني صالح.',
            'email.max' => 'يجب ألا يتجاوز البريد الإلكتروني 255 حرفًا.',
            'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل.',

            // gender
            'gender.required' => 'يرجى تحديد الجنس.',
            'gender.in' => 'يجب أن يكون الجنس إما ذكرًا أو أنثى.',

            // password
            'password.required' => 'يرجى إدخال كلمة المرور.',
            'password.string' => 'يجب أن تكون كلمة المرور نصًا.',
            'password.min' => 'يجب أن تحتوي كلمة المرور على 8 أحرف على الأقل.',
            'password.max' => 'يجب ألا تتجاوز كلمة المرور 50 حرفًا.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
            'password.regex' => 'يمكن أن تحتوي كلمة المرور على حروف، أرقام، والرموز التالية فقط: !@#$%^&*()-_=+{};:,<.>',
        ];
    }
}
