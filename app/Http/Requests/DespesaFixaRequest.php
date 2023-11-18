<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DespesaFixaRequest extends FormRequest
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


    public function rules()
    {
        $id= $this->segment(2);
        return [
            "descricao"         => "required",
            "dia_vencimento"    => "required",
            "valor"             => "required"
        ];
    }
}
