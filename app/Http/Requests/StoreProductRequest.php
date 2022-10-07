<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:255',
            'description' => 'min:10',
//            'category' => 'required|integer',
            'in_stock' => 'integer',
            'rating' => 'integer|digits_between:1,1|lt:6',
//            'images' => 'mimes:png,jpeg,gif'
        ];
    }

    /**
     * @param \Illuminate\Validation\Validator $validator
     * @return mixed
     */
//    public function withValidator($validator)
//    {
//        $validator->after(function ($validator) {
//            if ($this->somethingElseIsInvalid()) {
//                $validator->errors()->add('name', 'The field "name" must be not empty');
//                $validator->errors()->add('description', 'The field "description" must include minimum 6 characters');
//                $validator->errors()->add('category', 'The field "name" must be not empty and integer');
//                $validator->errors()->add('in_stock', 'The field must be integer');
//                $validator->errors()->add('rating', 'The field must be between 0 and 5');
//            }
//        });
//                return $validator;
//    }
}
