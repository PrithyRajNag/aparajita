<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyCreateOrganizationRequest extends FormRequest
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
            'hospital_name' => 'required|min:3',
            'owner_name' => 'required|min:3|max:30',
//            'email' => 'required',
            'email' => "unique:users,email,$this->id,id",
            'phone_number' => 'required|min:11|max:14',
            'address' => 'required',
            'bill' => 'required',
        ];
    }
}
