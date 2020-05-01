<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCuponRequest extends FormRequest
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
            'code' => 'required|unique:coupon|max:20',
            'discount' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'El cupón se encuentra registrado.'
        ];
    }
}
