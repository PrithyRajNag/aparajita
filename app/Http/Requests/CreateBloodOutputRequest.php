<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBloodOutputRequest extends FormRequest
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
            'name' => 'required|min:3|max:30',
            'address' => 'required|min:3',
            'phone_number' => 'required|min:11|max:14',
            'date' => 'required',
            'is_patient' => 'required',
            'blood_group_id' => 'required',
            'blood_collection_id' => 'required',

        ];
    }
}
