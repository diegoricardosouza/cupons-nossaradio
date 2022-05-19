<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCouponFormRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:3',
            'validity' => 'required',
            'city' => 'required',
            'image' => [
                'required',
                'image'
            ],
        ];

        if ($this->method('PUT')) {
            $rules['image'] = [
                'nullable'
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'      => 'O campo nome é de preenchimento obrigatório.',
            'name.min'           => 'O campo nome tem que possuir no minimo de 3 caracteres.',
            'validity.required'  => 'O campo Validade é de preenchimento obrigatório.',
            'city.required'      => 'O campo Cidade é de preenchimento obrigatório.',
            'image.required'     => 'O campo Imagem é de preenchimento obrigatório.',
        ];
    }
}
