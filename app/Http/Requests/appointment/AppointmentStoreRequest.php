<?php

namespace App\Http\Requests\appointment;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'department_name' => 'required|max:255',
            'doctor_name' => 'required',
            'appointment_time' => 'required',
        ];
    }
}
