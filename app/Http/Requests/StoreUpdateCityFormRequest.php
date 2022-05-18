<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCityFormRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3',
                "unique:cities,name,{$id},id",
            ]
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'      => 'O campo nome é de preenchimento obrigatório.',
            'name.min'           => 'O campo nome tem que possuir no minimo de 3 caracteres.',
            'name.unique'        => 'O campo nome informato já está sendo usado.',
        ];
    }
}
