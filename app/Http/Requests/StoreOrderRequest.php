<?php

    namespace App\Http\Requests;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Foundation\Http\FormRequest;

    class StoreOrderRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         */
        public function authorize(): bool
        {
            return Auth::check() && in_array(Auth::user()->role, ['user', 'admin']);
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
         */
        public function rules(): array
        {
            return [
                'product_id' => [
                    'required',
                    'integer',
                    'exists:products,id'
                ],

                // Only Arabic, French, English letters and spaces
                'client_name' => [
                    'required',
                    'string',
                    'min:3',
                    'regex:/^[\p{Arabic}a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/u'
                ],

                // City must be one of the allowed list
                'city' => [
                    'required',
                    'string',
                    'min:3',
                    'in:agadir,casablanca,rabat,marrakech,fes,meknes,tangier,tetoun,oujda,safi,el_jadida,berkane,kenitra,nador,khemisset,errachidia,beni_mellal,khouribga,taza,essaouira,guelmim,dakhla,settat,taourirt,chefchouen,midelt,ouarzazate,taroudant,tiznit,khenifra,al_hoceima,ouled_teima,sidi_slimane,sidi_bennour,fquih_ben_salah'
                ],

                // Address: allow Arabic/English/French letters, numbers, spaces, commas, dashes
                'client_address' => [
                    'required',
                    'string',
                    'min:3',
                    'regex:/^[\p{Arabic}a-zA-Z0-9À-ÖØ-öø-ÿ\s,\-\/]+$/u'
                ],

                // Moroccan phone: starts with 0 or +212 followed by 9 digits
                'client_phone' => [
                    'required',
                    'string',
                    'regex:/^(?:\+212|0)([ \-]?[5-7][0-9]{8})$/'
                ],

                // Quantity: only positive integers
                'quantity' => [
                    'required',
                    'integer',
                    'min:1'
                ],
            ];  
        }

        public function messages(): array
        {
            return [
                'client_name.required' => 'اسم الزبون مطلوب.',
                'client_name.regex' => 'يجب أن يحتوي الاسم فقط على الأحرف العربية أو الفرنسية أو الإنجليزية.',
                'client_name.min' => 'الاسم يجب أن يكون على الأقل 3 أحرف.',

                'city.required' => 'المدينة مطلوبة.',
                'city.in' => 'يجب اختيار مدينة صحيحة من القائمة.',

                'client_address.required' => 'العنوان مطلوب.',
                'client_address.regex' => 'العنوان يحتوي فقط على الحروف، الأرقام، المسافات، الفواصل أو الشرطات.',
                'client_address.min' => 'العنوان يجب أن يكون على الأقل 3 أحرف.',

                'client_phone.required' => 'رقم الهاتف مطلوب.',
                'client_phone.regex' => 'أدخل رقم هاتف مغربي صحيح (0XXXXXXXXX أو +212XXXXXXXXX).',

                'quantity.required' => 'الكمية مطلوبة.',
                'quantity.integer' => 'الكمية يجب أن تكون عدد صحيح.',
                'quantity.min' => 'الكمية يجب أن تكون 1 على الأقل.',
            ];
        }
    }
