<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->rol === 'administrador';
    }

    public function rules(): array
    {
        $usuarioId = $this->route('usuario')->id;

        return [
            'nombre'    => 'required|string|min:2|max:255',
            'apellidos' => 'required|string|min:2|max:255',
            'correo'    => 'required|email|unique:usuarios,correo,' . $usuarioId,
            'clave'     => 'nullable|string|min:6|max:100',
            'rol'       => 'required|string|in:administrador,gerente,empleado,cliente',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'    => 'El nombre es obligatorio.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'correo.required'    => 'El correo es obligatorio.',
            'correo.unique'      => 'Este correo ya está registrado.',
            'clave.min'          => 'La contraseña debe tener al menos 6 caracteres.',
            'rol.required'       => 'El rol es obligatorio.',
            'rol.in'             => 'El rol no es válido.',
        ];
    }
}