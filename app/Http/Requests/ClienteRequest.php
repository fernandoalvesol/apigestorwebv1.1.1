<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
        $id= $this->segment(2);
        $rules= [
            "tipo_cliente"      => "required",
            "nome_razao_social" => "required",
            "cpf_cnpj"          => "required",
            "indFinal"          => "required",
            "logradouro"        => "required",
            "numero"            => "required",
            "bairro"            => "required",
            "uf"                => "required"
        ];


        return $rules;
    }
}
