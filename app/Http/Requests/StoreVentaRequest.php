<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'producto_id'  => 'required|integer|exists:productos,id',
            'vendedor_id'  => 'required|integer|exists:usuarios,id',
            'cliente_id'   => 'required|integer|exists:usuarios,id',
            'fecha'        => 'required|date',
            'total'        => 'required|numeric|min:0',
            'ticket'       => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'producto_id.required'  => 'El producto es obligatorio.',
            'producto_id.integer'   => 'El producto debe ser un número válido.',
            'producto_id.exists'    => 'El producto no existe en el sistema.',
            'vendedor_id.required'  => 'El vendedor es obligatorio.',
            'vendedor_id.exists'    => 'El vendedor no existe en el sistema.',
            'cliente_id.required'   => 'El cliente es obligatorio.',
            'cliente_id.exists'     => 'El cliente no existe en el sistema.',
            'fecha.required'        => 'La fecha es obligatoria.',
            'fecha.date'            => 'La fecha no tiene un formato válido.',
            'total.required'        => 'El total es obligatorio.',
            'total.numeric'         => 'El total debe ser un número.',
            'total.min'             => 'El total no puede ser negativo.',
            'ticket.image'          => 'El ticket debe ser una imagen.',
            'ticket.max'            => 'El ticket no puede superar 2 MB.',
        ];
    }
}