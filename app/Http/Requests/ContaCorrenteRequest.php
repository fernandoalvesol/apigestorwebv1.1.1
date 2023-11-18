<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContaCorrenteRequest extends FormRequest
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
        return [
            "banco_id" => "required",
            "tipo_conta_corrente_id" => "required",
            "descricao" => "required",
            "agencia" => "required",
            "conta" => "required",
        ];
    }
}
