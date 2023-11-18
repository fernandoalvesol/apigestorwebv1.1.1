<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\NaturezaOperacao;

class NaturezaOperacaoRequest extends FormRequest
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

        return [
            'titulo_interno' => 'required',
            'natureza_operacao' => 'required',
            'tipo' => 'required',
            'indPres' => 'required',
            'finNFe' => 'required',
        ];
    }
}
