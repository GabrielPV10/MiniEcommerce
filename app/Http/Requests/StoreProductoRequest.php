<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'      => 'required|string|min:3|max:100',
            'descripcion' => 'required|string|min:5|max:255',
            'precio'      => 'required|numeric|min:0',
            'existencia'  => 'required|integer|min:0',
            'categorias'  => 'nullable|array',
            'categorias.*'=> 'exists:categorias,id',
            'fotos'       => 'nullable|array|max:5',
            'fotos.*'     => 'image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'      => 'El nombre es obligatorio.',
            'nombre.min'           => 'El nombre debe tener mínimo 3 caracteres.',
            'nombre.max'           => 'El nombre no puede exceder 100 caracteres.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.min'      => 'La descripción debe tener mínimo 5 caracteres.',
            'precio.required'      => 'El precio es obligatorio.',
            'precio.numeric'       => 'El precio debe ser un número.',
            'precio.min'           => 'El precio no puede ser negativo.',
            'existencia.required'  => 'La existencia es obligatoria.',
            'existencia.integer'   => 'La existencia debe ser un número entero.',
            'existencia.min'       => 'La existencia no puede ser negativa.',
            'categorias.*.exists'  => 'Una categoría seleccionada no existe.',
            'fotos.max'            => 'Puedes subir máximo 5 imágenes.',
            'fotos.*.image'        => 'Cada archivo debe ser una imagen.',
            'fotos.*.max'          => 'Cada imagen no puede superar 2 MB.',
        ];
    }
}