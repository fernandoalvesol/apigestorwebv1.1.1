<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NovaNfeRequest extends FormRequest
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
        $rules =  [
            'natureza_operacao_id'  => 'required',
            'emitente_id'           => 'required',
            'cliente_id'            => 'required',
        ];

        return $rules;
    }
}
