<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBloodInputRequest extends FormRequest
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

            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'age' => 'required',
            'address' => 'required|min:3',
            'phone_number' => 'required|min:11|max:14',
            'gender' => 'required',
            'date' => 'required',
            'bag_number' => 'required',
            'is_regular_donor' => 'required',
            'blood_group_id' => 'required',

        ];
    }
}
