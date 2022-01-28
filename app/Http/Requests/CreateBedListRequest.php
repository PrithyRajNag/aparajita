<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBedListRequest extends FormRequest
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
            'bed_number' => 'required|min:2',
            'bed_type_id' => 'required',
            'floor' => 'required',
            'price' => 'required',
            'is_available' => 'required|boolean',
            'status' => 'required|boolean'
        ];
    }
}
