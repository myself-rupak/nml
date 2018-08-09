<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DistrictName extends FormRequest
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
            "name.*" => 'required|distinct|unique:district,name'
        ];
    }

    public function messages()
    {
        return [
            "name.*.required" => 'Please write district name',
            "name.*.distinct" => 'Duplicate district name found',
            "name.*.unique" => 'Duplicate district name tried to be inserted',
        ];
    }
}
