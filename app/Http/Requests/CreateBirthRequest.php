<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBirthRequest extends FormRequest
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
            'name' => 'required|min:3|max:40',
            'father_name' => 'required|min:3|max:30',
            'mother_name' => 'required|min:3|max:30',
            'phone_number' => 'required|min:11|max:14',
            'weight' => 'required',
            'gender' => 'required',
            'date' => 'required',
            'time' => 'required',
            'blood_group_id' => 'required',
            'doctor_id' => 'required'

        ];
    }
}
