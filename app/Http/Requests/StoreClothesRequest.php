<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Auth;

    class StoreClothesRequest extends FormRequest
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
        public function rules()
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
                    'in:kids,girls,boys,man,women'
                ],
                'brand' => [
                    'required',
                    'string',
                    'min:3',
                    'regex:/^[\p{Arabic}A-Za-z\s]+$/u'
                ],
                'age' => [
                    'required',
                    'string',
                    'min:1',
                    'regex:/^[\p{Arabic}A-Za-z0-9_\-\s()]+$/u'
                ],
                'size' => [
                    'required',
                    'string',
                    'min:1',
                    'regex:/^[\p{Arabic}A-Za-z0-9\s\-,]+$/u'
                ],
                'images.*' => [
                    'required',
                    'image',
                    'mimes:png,jpg,jpeg',
                    'max:2048'
                ],
            ];
        }

        public function messages()
        {
            return [
                'name.required' => 'The product name is required.',
                'name.min' => 'The product name must be at least 4 characters.',
                'name.regex' => 'The product name may only contain Arabic, French, English letters, numbers, spaces, and commas.',

                'description_title.required' => 'The description title is required.',
                'description_title.min' => 'The description title must be at least 10 characters.',
                'description_title.regex' => 'The description title may only contain Arabic, French, English letters, numbers, spaces, commas, underscores, and dashes.',

                'description.required' => 'The description is required.',
                'description.regex' => 'The description may only contain Arabic, French, English letters, numbers, spaces, commas, underscores, and dashes.',

                'stock.required' => 'Stock quantity is required.',
                'stock.integer' => 'Stock must be an integer.',
                'stock.min' => 'Stock must be at least 1.',

                'price.required' => 'The price is required.',
                'price.numeric' => 'The price must be a number.',
                'price.regex' => 'The price format is invalid.',

                'category_id.required' => 'The category is required.',
                'category_id.integer' => 'Category ID must be an integer.',
                'category_id.min' => 'Category ID must be positive.',

                'gender.required' => 'The gender is required.',
                'gender.in' => 'Gender must be one of: kids, girls, boys, man, women.',

                'brand.required' => 'The brand is required.',
                'brand.min' => 'The brand must be at least 3 characters.',
                'brand.regex' => 'The brand may only contain Arabic, French, or English letters.',

                'age.required' => 'The age group is required.',
                'age.min' => 'The age group must be at least 1 character.',
                'age.regex' => 'The age may only contain Arabic, French, English letters, numbers, underscores, and dashes.',

                'size.required' => 'The size is required.',
                'size.min' => 'The size must be at least 1 character.',
                'size.regex' => 'The size may only contain Arabic, French, English letters, and numbers.',

                'images.*.required' => 'At least one image is required.',
                'images.*.image' => 'Each file must be an image.',
                'images.*.mimes' => 'Images must be in PNG, JPG, or JPEG format.',
                'images.*.max' => 'Each image must not exceed 2MB.',
            ];
        }
    }
