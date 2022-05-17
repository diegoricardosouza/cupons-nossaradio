<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $id = $this->id ?? '';

        $rules = [
            'name' => 'required|string|max:255|min:3',
            'email' => [
                'required',
                'email',
                "unique:users,email,{$id},id",
            ],
            'password' => 'required|min:6|max:15|confirmed',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'      => 'O campo nome é de preenchimento obrigatório.',
            'name.min:3'         => 'O campo nome tem que possuir no minimo de 3 caracteres.',
            'email.required'     => 'O campo email é de preenchimento obrigatório.',
            'email.email'        => 'O e-mail informato tem o formato inválido.',
            'email.unique'       => 'O e-mail informato já está sendo usado por outro usuário.',
            'password.required'  => 'O campo senha é de preenchimento obrigatório.',
            'password.min'       => 'A senha precisa ter no minimo 6 caracteres.',
            'password.confirmed' => 'As senhas nao correspondem.',
        ];
    }
}
