<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCategoryRequest extends FormRequest
{
    /**
         * Determine if the user is authorized to make this request.
         */
        public function authorize(): bool
        {
            return Auth::check() && Auth::user()->role === 'admin';
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
                    'max:50',
                    'regex:/^[\p{Arabic}a-zA-ZÀ-ÖØ-öø-ÿ\s\-,]+$/u',
                ],
                'description' => [
                    'required',
                    'string',
                    'max:500',
                    'regex:/^[\p{Arabic}\p{L}\p{N}\s,\.\_\-\?!]+$/u',
                ],
                'image' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,gif,webp',
                    'max:2048',
                ],
            ];
        }

        /**
         * Get custom error messages for validation rules.
         *
         * @return array<string, string>
         */
        public function messages() {
            return [
                'name.regex' => 'The category name may only contain letters and spaces.',
                'description.regex' => 'The description contains invalid characters. Only letters, numbers, spaces, and basic punctuation are allowed.',
                'image.max' => 'The image must not be larger than 2MB.',
                'image.mimes' => 'The image must be a file of type: jpg, jpeg, png, gif.',
            ];
        }
}
