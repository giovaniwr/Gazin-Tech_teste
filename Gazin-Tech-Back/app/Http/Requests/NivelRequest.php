<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NivelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nivel' => 'required | max:255 ' ,
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'nivel.required' => 'O campo nivel é obrigatório.',
        ];
    }
}
