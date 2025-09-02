<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreHealthAndBeautyRequest extends FormRequest
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
                'min:4',
                'regex:/^[\p{Arabic}A-Za-z0-9\s,]+$/u'
            ],
            'description_title' => [
                'required',
                'string',
                'min:10',
                'regex:/^[\p{Arabic}A-Za-z0-9\s,._-]+$/u'
            ],
            'description' => [
                'required',
                'string',
                'regex:/^[\p{Arabic}A-Za-z0-9\s,._-]+$/u'
            ],
            'stock' => [
                'required',
                'integer',
                'min:1'
            ],
            'price' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'old_price' => [
                'nullable',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'category_id' => [
                'required',
                'integer',
                'min:1'
            ],
            'gender' => [
                'required',
                'string',
                'in:male,female,both'
            ],
            'brand' => [
                'required',
                'string',
                'min:3',
                'regex:/^[\p{Arabic}A-Za-z\s]+$/u'
            ],
            'skin_type' => [
                'required',
                'string',
                'min:3',
                'regex:/^[\p{Arabic}A-Za-z\s]+$/u'
            ],
            'has_fragrance' => [
                'required',
                'string',
                'min:1',
                'regex:/^[\p{Arabic}A-Za-z0-9\s\-,،.]+$/u'
            ],
            'images.*' => [
                'required',
                'image',
                'mimes:png,jpg,jpeg',
                'max:2048'
            ],
        ];
    }
}
