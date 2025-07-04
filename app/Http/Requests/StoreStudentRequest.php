<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'last_name' => 'required|string|max:50',
            'mothers_last_name' => 'nullable|string|max:50',
            'rfc' => 'nullable|string|regex:/^[A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3}$/i',
            'worker_number' => 'nullable|string|max:30|unique:student,worker_number',
            'student_number' => 'nullable|string|max:30|unique:student,student_number',
            'phone_number' => 'nullable|string|max:15',
            'degree' => 'nullable|string|max:40',
            'email' => 'nullable|email|max:40',
            'gender' => 'required|in:M,F',
        ];
    }

    public function messages(): array
    {
        return [
            'rfc.regex' => 'El RFC no tiene un formato válido. Debe tener 10 u 13 caracteres, incluyendo letras y números.',
            'worker_number.unique' => 'Este número de trabajador ya está registrado.',
            'student_number.unique' => 'Este número de estudiante ya está registrado.',
            'email.email' => 'El correo electrónico no es válido.',
            'gender.in' => 'El género debe ser M o F.',
        ];
    }
}
