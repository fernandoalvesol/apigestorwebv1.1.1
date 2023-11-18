<?php
use App\Service\ConstanteService;
?>
@extends('template')
@section('conteudo')
    <div class="rows cat-financeiro">
        <div class="col-12">
            <div class="caixa">
                <div class="p-2 text-uppercase justify-center d-flex">
                    <span class="h5 mb-0 d-flex center-middle bg-title">
                        <svg class="icon financeiro" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 4V16M7 13.182L7.879 13.841C9.05 14.72 10.949 14.72 12.121 13.841C13.293 12.962 13.293 11.538 12.121 10.659C11.536 10.219 10.768 10 10 10C9.275 10 8.55 9.78 7.997 9.341C6.891 8.462 6.891 7.038 7.997 6.159C9.103 5.28 10.897 5.28 12.003 6.159L12.418 6.489M19 10C19 11.1819 18.7672 12.3522 18.3149 13.4442C17.8626 14.5361 17.1997 15.5282 16.364 16.364C15.5282 17.1997 14.5361 17.8626 13.4442 18.3149C12.3522 18.7672 11.1819 19 10 19C8.8181 19 7.64778 18.7672 6.55585 18.3149C5.46392 17.8626 4.47177 17.1997 3.63604 16.364C2.80031 15.5282 2.13738 14.5361 1.68508 13.4442C1.23279 12.3522 1 11.1819 1 10C1 7.61305 1.94821 5.32387 3.63604 3.63604C5.32387 1.94821 7.61305 1 10 1C12.3869 1 14.6761 1.94821 16.364 3.63604C18.0518 5.32387 19 7.61305 19 10Z"
                                stroke="#341008" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg> Confirmar Recebimento da Conta: <b class="text-vermelho ml-3"> {{ $contareceber->id }}</b>
                    </span>
                </div>
            </div>


            <div class="col-12 mb-4 mt-0">
                <fieldset class="caixa border radius-4 detalhes">
                    <legend class="h5"> Dados da Conta a Receber: {{ $contareceber->id }} </legend>

                    <div class="caixa">
                        <div class="px-4">
                            <div class="rows pt-0 pb-3">
                                <div class="col-4 mb-3">
                                    <label class="text-label">Descricao</label>
                                    <input type="text" name="descricao" readonly="readonly"
                                        value="{{ $contareceber->descricao }}" id="descricao" class="form-campo">
                                </div>
                                <div class="col-4">
                                    <label class="text-label d-block">Cliente</label>
                                    <input type="text" name="cliente" readonly="readonly"
                                        value="{{ $contareceber->cliente->nome_razao_social }}" class="form-campo">
                                </div>
                                <div class="col-2 mb-3">
                                    <label class="text-label">Data Emissão</label>
                                    <input type="date" name="data_emissao" readonly="readonly"
                                        value="{{ $contareceber->data_emissao }}" id="data_emissao" readonly
                                        class="form-campo">
                                </div>

                                <div class="col-2 mb-3">
                                    <label class="text-label">Data Vencimento</label>
                                    <input type="date" name="data_vencimento" readonly="readonly"
                                        value="{{ $contareceber->data_vencimento }}" readonly id="data_vencimento"
                                        class="form-campo">
                                </div>
                                <div class="col-2 mb-3">
                                    <label class="text-label">Valor Original</label>
                                    <input type="text" readonly="readonly" readonly="readonly"
                                        value="{{ $contareceber->valor }}" class="form-campo mascara-float">
                                </div>

                                <div class="col-2 mb-3">
                                    <label class="text-label">Total Juros</label>
                                    <input type="text" readonly="readonly" readonly="readonly"
                                        value="{{ $contareceber->total_juros }}" class="form-campo mascara-float">
                                </div>

                                <div class="col-2 mb-3">
                                    <label class="text-label">Total Multa</label>
                                    <input type="text" readonly="readonly" readonly="readonly"
                                        value="{{ $contareceber->total_multa }}" class="form-campo mascara-float">
                                </div>

                                <div class="col-2 mb-3">
                                    <label class="text-label">Total Desconto</label>
                                    <input type="text" readonly="readonly" readonly="readonly"
                                        value="{{ $contareceber->total_desconto }}" class="form-campo mascara-float">
                                </div>

                                <div class="col-2 mb-3">
                                    <label class="text-label">Total Recebido</label>
                                    <input type="text" readonly="readonly" readonly="readonly"
                                        value="{{ $contareceber->total_recebido }}" class="form-campo mascara-float">
                                </div>

                                <div class="col-2 mb-3">
                                    <label class="text-label">Total Restante</label>
                                    <input type="text" readonly="readonly" readonly="readonly"
                                        value="{{ $contareceber->total_restante }}" class="form-campo mascara-float">
                                </div>


                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <form action="{{ route('contareceber.receber') }}" method="post">
                @csrf
                <div class="col-12 mb-4">
                    <input type="hidden" name="tipo_documento"
                        value="{{ $contareceber->venda_id ? config('constantes.tipo_documento.VENDA') : config('constantes.tipo_documento.AVULSO') }}">

                    <fieldset class="caixa border radius-4">
                        <legend class="h5"> Dados do Pagamento</legend>

                        <div class="caixa">
                            <div class="px-3">
                                <div class="rows pb-1">
                                    <div class="col-2 mb-3">
                                        <label class="text-label">Data Pagamento</label>
                                        <input type="date" name="data_pagamento" required value="{{ hoje() }}"
                                            id="data_pagamento" readonly class="form-campo">
                                    </div>

                                    <div class="col-2 mb-3">
                                        <label class="text-label">Forma de Pagamento</label>
                                        <select name="forma_pagto_id" class="form-campo" required>
                                            <option value="">Selecione uma Opção</option>
                                            @foreach ($formaPagto as $f)
                                                <option value='{{ $f->id }}'> {{ $f->forma_pagto }}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="col-4">
                                        <label class="text-label d-block ">Conta Corrente </label>
                                        <select name="conta_corrente_id" class="form-campo">
                                            @foreach ($contascorrentes as $conta)
                                                <option value="{{ $conta->id }}"
                                                    {{ $contareceber->conta_corrente_id == $conta->id ? 'selected' : '' }}>
                                                    {{ $conta->descricao }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label class="text-label d-block ">Classificação Financeira </label>
                                        <select name="classificacao_financeira_id" class="form-campo">
                                            @foreach ($planocontas as $c)
                                                <option value="{{ $c->id }}"
                                                    {{ $contareceber->classificacao_financeira_id == $c->id ? 'selected' : '' }}>
                                                    {{ $c->codigo }} - {{ $c->conta }}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="col-2 mb-3">
                                        <label class="text-label">Juros</label>
                                        <input type="text" name="juros" value="0" id="juros"
                                            onkeyup="atualizaValor()" class="form-campo mascara-float">
                                    </div>
                                    <div class="col-2 mb-3">
                                        <label class="text-label">Multa</label>
                                        <input type="text" name="multa" value="0" id="multa"
                                            onkeyup="atualizaValor()" class="form-campo mascara-float">
                                    </div>

                                    <div class="col-2 mb-3">
                                        <label class="text-label">Desconto</label>
                                        <input type="text" name="desconto" value="0" id="desconto"
                                            onkeyup="atualizaValor()" class="form-campo mascara-float">
                                    </div>
                                    <div class="col-2 mb-3">
                                        <label class="text-label">Valor a Receber</label>
                                        <input type="text" name="valor_original" id="valor_original"
                                            onkeyup="atualizaValor()" required
                                            value="{{ $contareceber->total_restante }}" class="form-campo mascara-float">
                                    </div>

                                    <div class="col-2 mb-3">
                                        <label class="text-label">Valor Liquido</label>
                                        <input type="text" name="valor_liquido" required readonly id="valor_a_receber"
                                            value="{{ $contareceber->total_restante }}" class="form-campo mascara-float">
                                    </div>
                                    <div class="col-2 mb-3">
                                        <label class="text-label">Documento</label>
                                        <input type="text" name="numero_documento" id="numero_documento"
                                            class="form-campo">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="text-label">Observação</label>
                                        <input type="text" name="observacao" id="observacao" class="form-campo">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="p-3">
                        <div class="caixa-rodape">
                            <input type="hidden" name="conta_receber_id" value="{{ $contareceber->id }}" />
                            <input type="submit" value="Salvar" class="btn btn-verde btn-medio block m-auto" />
                        </div>
                    </div>

                </div>

            </form>

        </div>
    </div>
    <script>
        function atualizaValor() {
            var saldo_devedor = ($('#valor_original').val() != "") ? converteMoedaFloat($('#valor_original').val()) :
                parseFloat(0);
            var juros = ($('#juros').val() != "") ? converteMoedaFloat($('#juros').val()) : parseFloat(0);
            var multa = ($('#multa').val() != "") ? converteMoedaFloat($('#multa').val()) : parseFloat(0);
            var desconto = ($('#desconto').val() != "") ? converteMoedaFloat($('#desconto').val()) : parseFloat(0);



            var valor_a_receber = parseFloat(saldo_devedor) + parseFloat(juros) + parseFloat(multa) - parseFloat(desconto);
            $('#valor_a_receber').val(converteFloatMoeda(valor_a_receber));

        }
    </script>
@endsection
