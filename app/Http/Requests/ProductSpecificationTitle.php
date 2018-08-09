<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSpecificationTitle extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title.*" => 'required|distinct|unique:product_specification,title',
        ];
    }

    public function messages()
    {
        return [
            "title.*.required" => 'Please write product specification title',
            "title.*.distinct" => 'Duplicate product specification title found',
            "title.*.unique" => 'Duplicate product specification title tried to be inserted',
        ];
    }
}
