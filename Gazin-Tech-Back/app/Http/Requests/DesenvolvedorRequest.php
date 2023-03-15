<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesenvolvedorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
             'nome' => 'required',
             'nivelId' => 'required',
             'sexo' => 'required',
             'datanascimento' => 'required',
             'idade' => 'required',
             'hobby' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O campo Nome é obrigatório.',
            'sexo.required' => 'O campo Sexo é obrigatório.',
            'datanascimento.required' => 'O campo Data de nascimento é obrigatório.',
            'idade.required' => 'O campo Idade é obrigatório.',
            'hobby.required' => 'O campo nivel é obrigatório.',
        ];
    }
}
