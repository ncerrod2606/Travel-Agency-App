<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacacionCreateRequest extends FormRequest
{

    function attributes(): array {
        return [
            'titulo'        => 'título de la vacación',
            'idtipo'        => 'tipo de vacación',
            'descripcion'   => 'descripción',
            'precio'        => 'precio',
            'pais'          => 'país',
            'image'         => 'foto', // File input name often stays 'image' or 'foto'
        ];
    }

    function authorize(): bool {
        return true;
    }

    function messages(): array {
        $required = 'Es obligatorio introducir :attribute.';
        $min = 'La longitud minima del campo :attribute es :min.';
        $max = 'La longitud máximo del campo :attribute es :max.';
        $minNumber = 'La valor minima del campo :attribute es :min.';
        $maxNumber = 'La valor máximo del campo :attribute es :max.';
        $unique = 'El título de la vacación es único. Ese título ya se ha usado.';
        return [
            'titulo.required'   => $required,
            'titulo.string'     => 'El título tiene que ser una cadena.',
            'titulo.min'        => $min,
            'titulo.max'        => $max,
            'titulo.unique'     => $unique,
            'idtipo.required'   => $required,
            'idtipo.exists'     => 'El tipo de vacación no existe.',
            'precio.required'   => $required,
            'precio.numeric'    => 'El precio tiene que ser un número.',
            'precio.min'        => $minNumber,
            'precio.max'        => $maxNumber,
            'pais.required'     => $required,
            'image.image'       => 'El archivo tiene que ser una imagen.',
            'image.size'        => 'La imagen no puede pesar más de 1000 KB.',
        ];
    }

    function rules(): array {
        return [
            'titulo'      => 'required|string|min:2|max:100|unique:vacacion,titulo',
            'idtipo'      => 'required|exists:tipo,id',
            'descripcion' => 'required|string|min:10',
            'precio'      => 'required|numeric|min:0|max:999999.99|decimal:0,2',
            'pais'        => 'required|string|min:2|max:100',
            'image'       => 'nullable|image' // Form field 'image'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        \Illuminate\Support\Facades\Log::error('Vacacion validation failed', $validator->errors()->toArray());
        parent::failedValidation($validator);
    }
}