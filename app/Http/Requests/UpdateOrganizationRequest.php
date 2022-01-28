<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
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
            'organization_name' => 'required|min:3',
            'organization_type' => 'required|min:3',
            'organization_address' => 'required',
            'logo' => 'mimes:jpg,jpeg,gif,,png,svg | max:5120',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required',
            'phone_number' => 'required|min:11|max:14',
            'address' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'nid' => 'required|min:10',
            'blood_group_id' => 'required',
        ];
    }
}
