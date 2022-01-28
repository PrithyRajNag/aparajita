<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyEmployeeRequest extends FormRequest
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
            'first_name'=> 'required|max:30',
            'last_name'=> 'required|max:30',
            'phone_number'=> 'required|min:11|max:14',
            'gender'=>'required',
            'dob'=> 'required',
            'address'=> 'required',
            'company_designation_id'=> 'required',
//            'email'=> 'required',
            'email' => "unique:users,email,$this->id,id",
        ];
    }
}
