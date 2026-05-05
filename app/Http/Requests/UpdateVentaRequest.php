<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return in_array(auth()->user()?->rol, ['administrador', 'gerente']);
    }

    public function rules(): array
    {
        return [
            'producto_id' => 'required|numeric|exists:productos,id',
            'vendedor_id' => 'required|numeric|exists:usuarios,id',
            'cliente_id'  => 'required|numeric|exists:usuarios,id',
            'fecha'       => 'required|date',
            'total'       => 'required|numeric|min:0',
            'ticket'      => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'producto_id.required' => 'El producto es obligatorio.',
            'producto_id.exists'   => 'El producto no existe.',
            'vendedor_id.required' => 'El vendedor es obligatorio.',
            'vendedor_id.exists'   => 'El vendedor no existe.',
            'cliente_id.required'  => 'El cliente es obligatorio.',
            'cliente_id.exists'    => 'El cliente no existe.',
            'fecha.required'       => 'La fecha es obligatoria.',
            'total.required'       => 'El total es obligatorio.',
            'total.min'            => 'El total no puede ser negativo.',
            'ticket.image'         => 'El ticket debe ser una imagen.',
            'ticket.max'           => 'El ticket no debe pesar más de 2MB.',
        ];
    }
}