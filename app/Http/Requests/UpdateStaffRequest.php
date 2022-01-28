<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffRequest extends FormRequest
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
            'first_name'=> 'required|min:3',
            'last_name'=> 'required|min:3',
            'phone_number'=> 'required|min:11|max:14',
            'gender'=>'required',
            'dob'=> 'required',
            'address'=> 'required',
            'blood_group_id'=> 'required',
            'nid'=> 'required|min:10|max:17',
            'salary'=> 'required',
            'role' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
