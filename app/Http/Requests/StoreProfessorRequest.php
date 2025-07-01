<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfessorRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        // Cambia a true si no estás manejando permisos personalizados
        return true;
    }

    /**
     * Reglas de validación para almacenar un profesor.
     */
    public function rules(): array
    {
        return [
            'name'               => 'required|string|max:100',
            'last_name'          => 'required|string|max:50',
            'mothers_last_name'  => 'nullable|string|max:50',
            'rfc'                => 'nullable|string|unique:professor,rfc|min:10|max:13',
            'worker_number'      => 'nullable|string|unique:professor,worker_number|max:30',
            'student_number'     => 'nullable|string|unique:professor,student_number|max:30',
            'birthdate'          => 'nullable|date',
            'phone_number'       => 'nullable|string|max:15',
            'degree'             => 'nullable|string|max:40',
            'email'              => 'nullable|email|max:40',
            'gender'             => 'nullable|in:M,F',
            'semblance'          => 'nullable|string|max:200',
            'is_instructor'      => 'boolean',
            'provenance'         => 'nullable|string|max:100',
        ];
    }

    /**
     * Mensajes personalizados de error (opcional).
     */
    public function messages(): array
    {
        return [
            'rfc.unique' => 'El RFC ya está registrado.',
            'worker_number.unique' => 'El número de trabajador ya está registrado.',
            'email.email' => 'El correo electrónico no es válido.',
            'gender.in' => 'El género debe ser M o F.',
            'is_instructor.required' => 'Debe indicar si es instructor.',
        ];
    }
}
