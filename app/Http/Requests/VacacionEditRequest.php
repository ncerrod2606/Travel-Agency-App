<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacacionEditRequest extends FormRequest
{
    function authorize(): bool {
        return true;
    }

    function rules(): array {
        return [
            'titulo'      => 'nullable|string|min:2|max:100', // Unique check excluded for edit or needs ignore ID
            'idtipo'      => 'nullable|exists:tipo,id',
            'descripcion' => 'nullable|string|min:10',
            'precio'      => 'nullable|numeric|min:0|max:999999.99|decimal:0,2',
            'pais'        => 'nullable|string|min:2|max:100',
            'image'       => 'nullable|image'
        ];
    }
}