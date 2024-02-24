<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferAppliedRequest extends FormRequest
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
            'new_district_id'=>'required',
            'new_block_id'=>'required',
            'new_gram_panchayat_id'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'new_district_id.required'=>'Please Select the District',
            'new_block_id.required'=>'Please Select the mandatory',
            'new_gram_panchayat_id.required'=>'Please Select the mandatory'
        ];
    }
}
