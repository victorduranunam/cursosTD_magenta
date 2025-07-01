<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    // Autoriza que cualquier usuario pueda hacer esta solicitud (puedes ajustarlo si deseas)
    public function authorize(): bool
    {
        return true;
    }

    // Reglas de validación
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'last_name' => 'required|string|max:50',
            'mothers_last_name' => 'nullable|string|max:50',
            'rfc' => [
                'required',
                'string',
                'max:13',
                'min:10',
                'regex:/^[A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3}$/i',
                'unique:student,rfc',
            ],
            'worker_number' => 'nullable|string|max:30|unique:student,worker_number',
            'student_number' => 'nullable|string|max:30|unique:student,student_number',
            'phone_number' => 'nullable|string|max:15',
            'degree' => 'nullable|string|max:40',
            'email' => 'required|email|max:40',
            'gender' => 'required|in:M,F',
        ];
    }
}
