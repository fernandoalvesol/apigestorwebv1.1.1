<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
            "nome"          => "required",
            "origem"        => "required",
            "preco_venda"   => "required",
            "ncm"           => "required",
            "imagem"        =>"nullable"
        ];

        if(!is_null($this->imagem)){
            $rules['imagem']     = 'file|mimetypes:image/png,image/jpg,image/jpeg|image:jpg,png,jpeg';
        }
        return $rules;
    }
}
