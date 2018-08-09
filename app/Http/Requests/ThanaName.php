<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThanaName extends FormRequest
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
            "name.*" => 'required|distinct|unique:thana,name',
            "district_id" => 'required',
        ];
    }

    public function messages()
    {
        return [
            "name.*.required" => 'Please write thana name',
            "name.*.distinct" => 'Duplicate thana name found',
            "name.*.unique" => 'Duplicate thana name tried to be inserted',
            "district_id.required" => 'Please select district first',
        ];
    }
}
