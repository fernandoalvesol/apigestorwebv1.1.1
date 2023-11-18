<?php
use App\Service\ConstanteService;
?>
@extends('template')
@section('conteudo')
    <div class="rows">
        <div class="col-12">
            <span class=" bg-title text-light text-uppercase h5 mb-0 text-branco">
                <svg class="icon cadastro" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.5 14.875H14.875M14.875 14.875H18.25M14.875 14.875V11.5M14.875 14.875V18.25M4 8.5H6.25C6.84674 8.5 7.41903 8.26295 7.84099 7.84099C8.26295 7.41903 8.5 6.84674 8.5 6.25V4C8.5 3.40326 8.26295 2.83097 7.84099 2.40901C7.41903 1.98705 6.84674 1.75 6.25 1.75H4C3.40326 1.75 2.83097 1.98705 2.40901 2.40901C1.98705 2.83097 1.75 3.40326 1.75 4V6.25C1.75 6.84674 1.98705 7.41903 2.40901 7.84099C2.83097 8.26295 3.40326 8.5 4 8.5ZM4 18.25H6.25C6.84674 18.25 7.41903 18.0129 7.84099 17.591C8.26295 17.169 8.5 16.5967 8.5 16V13.75C8.5 13.1533 8.26295 12.581 7.84099 12.159C7.41903 11.7371 6.84674 11.5 6.25 11.5H4C3.40326 11.5 2.83097 11.7371 2.40901 12.159C1.98705 12.581 1.75 13.1533 1.75 13.75V16C1.75 16.5967 1.98705 17.169 2.40901 17.591C2.83097 18.0129 3.40326 18.25 4 18.25ZM13.75 8.5H16C16.5967 8.5 17.169 8.26295 17.591 7.84099C18.0129 7.41903 18.25 6.84674 18.25 6.25V4C18.25 3.40326 18.0129 2.83097 17.591 2.40901C17.169 1.98705 16.5967 1.75 16 1.75H13.75C13.1533 1.75 12.581 1.98705 12.159 2.40901C11.7371 2.83097 11.5 3.40326 11.5 4V6.25C11.5 6.84674 11.7371 7.41903 12.159 7.84099C12.581 8.26295 13.1533 8.5 13.75 8.5Z"
                        stroke="#341008" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                CADASTRAR PRODUTO
            </span>
        </div>

        <div class="col-12">
            <form action="{{ route('produto.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="rows p-4">
                    <div class="col-4 d-flex">
                        <label class="py-1 px-2 mt-3 border text-center position-relative edit-upload">
                            <img src="{{ asset('assets/img/semproduto.png') }}" class="img-fluido opaco" id="imgUp">
                            <input type="file" name="imagem" id="img_produto"
                                onchange="valida_imagem('img_produto', 'imgUp' )">
                            <span>Carregar produto</span>
                        </label>
                    </div>


                    <div class="col-8 px-2">
                        <div class="rows">
                            <div class="col-12 mb-3">
                                <label class="text-label">Nome do produto</label>
                                <input type="text" name="nome" value="{{ old('nome') }}" class="form-campo"
                                    required>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="text-label">NCM</label>
                                <input type="text" name="ncm" value="{{ old('ncm') }}" data-mask="0000.00.00"
                                    maxlength="10" class="form-campo" required>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="text-label">Código Barra/Gtin/EanTrib</label>
                                <input type="text" name="gtin" value="{{ old('gtin') }}" class="form-campo">
                            </div>
                            <div class="col-4 mb-3">
                                <label class="text-label">Cest</label>
                                <input type="text" name="cest" value="{{ old('cest') }}" class="form-campo">
                            </div>

                            <div class="col-6 mb-3">
                                <label class="text-label">Origem</label>
                                <select class="form-campo" name="origem">
                                    @foreach (ConstanteService::listaOrigem() as $chave => $valor)
                                        <option value="{{ $chave }}">{{ $valor }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 mb-3">
                                <label class="text-label">Categoria</label>
                                <div class="group-btn d-flex center-midlle">
                                    <select class="form-campo" name="categoria_id" id="cb_categoria_id">
                                        @foreach ($categorias as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->categoria }} </option>
                                        @endforeach
                                    </select>
                                    <a href="javascript:;" onclick="abrirModal('#modalCategoria')"
                                        class="text-verde p-1 border radius-50 ml-1 fas fa-plus"
                                        title="Inserir nova categoria"></a>
                                </div>
                            </div>

                            <div class="col-4 mb-3">
                                <label class="text-label">Unidade</label>
                                <select class="form-campo" name="unidade" required>
                                    @foreach ($unidades as $u)
                                        <option value="{{ $u->unidade }}"> {{ $u->unidade }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-4 mb-3">
                                <label class="text-label">Estoque Inicial</label>
                                <input type="text" name="estoque_inicial" value="{{ old('estoque_inicial') }}"
                                    class="form-campo mascara-float">
                            </div>
                            <div class="col-4 mb-3">
                                <label class="text-label">Estoque Máximo</label>
                                <input type="text" name="estoque_maximo" value="{{ old('estoque_maximo') }}"
                                    class="form-campo mascara-float">
                            </div>

                            <div class="col mb-3">
                                <label class="text-label">Estoque Minimo</label>
                                <input type="text" name="estoque_minimo" value="{{ old('estoque_minimo') }}"
                                    class="form-campo mascara-float">
                            </div>
                            <div class="col mb-3">
                                <label class="text-label">Preço Custo</label>
                                <input type="text" name="preco_custo" value="{{ old('preco_custo') }}" id="preco_custo"
                                    onkeyup="calcularPreco()" class="form-campo mascara-float">
                            </div>

                            <div class="col mb-3">
                                <label class="text-label">(%) Margem Lucro</label>
                                <input type="text" name="margem_lucro" value="{{ old('margem_lucro') }}"
                                    onkeyup="calcularPreco()" id="margem_lucro" class="form-campo mascara-float">
                            </div>

                            <div class="col mb-3">
                                <label class="text-label">Preço Venda</label>
                                <input type="text" name="preco_venda" value="{{ old('preco_venda') }}"
                                    id="preco_venda" class="form-campo mascara-float" required>
                            </div>

                            <div class="col-12 mt-4">
                                <input type="submit" value="Inserir Novo Produto"
                                    class="btn btn-padrao btn-medio d-block m-auto">
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>

    </div>
    @include('Cadastro.Categoria.modalCategoria')
@endSection
