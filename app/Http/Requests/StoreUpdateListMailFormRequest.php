<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateListMailFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->id ?? '';

        $rules = [
            'email' => [
                'required',
                'email',
                "unique:list_mails,email,{$id},id",
            ],
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'email.required'     => 'O campo email é de preenchimento obrigatório.',
            'email.email'        => 'O e-mail informato tem o formato inválido.',
            'email.unique'       => 'O e-mail informato já está cadastrado.',
        ];
    }
}
