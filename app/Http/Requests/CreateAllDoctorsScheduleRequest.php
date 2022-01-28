<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAllDoctorsScheduleRequest extends FormRequest
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
            'week_day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'patient_limit' => 'required',
            'doctor_id' => 'required',
        ];
    }
}
