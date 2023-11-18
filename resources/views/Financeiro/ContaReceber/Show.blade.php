@extends('template')
@section('conteudo')
    <div class="cat-financeiro">
        <div class="rows">

            <div class="col-12">
                <div class="caixa">
                    <span class="p-2 mb-3 text-light text-uppercase  text-branco justify-center d-flex">
                        <span class=" bg-title text-light text-uppercase h5 mb-0 text-branco">
                            <svg class="icon financeiro" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 4V16M7 13.182L7.879 13.841C9.05 14.72 10.949 14.72 12.121 13.841C13.293 12.962 13.293 11.538 12.121 10.659C11.536 10.219 10.768 10 10 10C9.275 10 8.55 9.78 7.997 9.341C6.891 8.462 6.891 7.038 7.997 6.159C9.103 5.28 10.897 5.28 12.003 6.159L12.418 6.489M19 10C19 11.1819 18.7672 12.3522 18.3149 13.4442C17.8626 14.5361 17.1997 15.5282 16.364 16.364C15.5282 17.1997 14.5361 17.8626 13.4442 18.3149C12.3522 18.7672 11.1819 19 10 19C8.8181 19 7.64778 18.7672 6.55585 18.3149C5.46392 17.8626 4.47177 17.1997 3.63604 16.364C2.80031 15.5282 2.13738 14.5361 1.68508 13.4442C1.23279 12.3522 1 11.1819 1 10C1 7.61305 1.94821 5.32387 3.63604 3.63604C5.32387 1.94821 7.61305 1 10 1C12.3869 1 14.6761 1.94821 16.364 3.63604C18.0518 5.32387 19 7.61305 19 10Z"
                                    stroke="#341008" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            Confirmar Recebimento
                            da Conta: <b class="text-vermelho ml-3"> {{ $contareceber->id }}</b> </span>
                    </span>
                    <!--<div class="d-flex">
                                    @if (isset($contareceber->venda_id))
    <a href="{{ route('venda.financeiro', $contareceber->venda_id) }}"
                                            class="btn btn-azul btn-pequeno ml-1" title="Voltar"><i class="fas fa-arrow-left"></i>
                                        </a>
@else
    <a href="{{ route('contareceber.index') }}" class="btn btn-azul btn-pequeno ml-1"
                                            title="Voltar"><i class="fas fa-arrow-left"></i> </a>
    @endif
                                    <a href="" class="retorna btn btn-roxo btn-pequeno ml-1 d-inline-block" title="Menu"><i
                                            class="fas fa-bars"></i></a>
                                </div>-->
                </div>


                <div class="col-12 mb-4">
                    <div class="caixa detalhes border radius-4 caixafield p-0">
                        <span class="p-2 py-1 bg-financeiro text-center text-uppercase h5 mb-0 text-branco"> Dados da Conta
                            a Receber: {{ $contareceber->id }}</span>

                        <div class="caixa">
                            <div class="px-4">
                                <div class="rows pt-3 pb-4">
                                    <div class="col-4 mb-3 d-flex center-middle">
                                        <label class="text-label">Descricao</label>
                                        <input type="text" name="descricao" readonly="readonly"
                                            value="{{ $contareceber->descricao }}" id="descricao" class="form-campo">
                                    </div>
                                    <div class="col-4 mb-3 d-flex center-middle">
                                        <label class="text-label d-block">Cliente</label>
                                        <input type="text" name="cliente" readonly="readonly"
                                            value="{{ $contareceber->cliente->nome_razao_social }}" class="form-campo">
                                    </div>
                                    <div class="col-4 mb-3  d-flex center-middle">
                                        <label class="text-label col-4 pb-0">Data Emissão</label>
                                        <input type="date" name="data_emissao" readonly="readonly"
                                            value="{{ $contareceber->data_emissao }}" id="data_emissao" readonly
                                            class="form-campo">
                                    </div>

                                    <div class="col-3 mb-3 d-flex center-middle">
                                        <label class="text-label">Data Vencimento</label>
                                        <input type="date" name="data_vencimento" readonly="readonly"
                                            value="{{ $contareceber->data_vencimento }}" readonly id="data_vencimento"
                                            class="form-campo">
                                    </div>
                                    <div class="col-3 mb-3  d-flex center-middle">
                                        <label class="text-label">Valor</label>
                                        <input type="text" name="valor" id="valor_original" readonly="readonly"
                                            readonly="readonly" value="{{ $contareceber->valor }}" class="form-campo">
                                    </div>
                                    <div class="col-3 mb-3  d-flex center-middle">
                                        <label class="text-label">Total Recedito</label>
                                        <input type="text" name="valor" id="valor_original" readonly="readonly"
                                            readonly="readonly" value="{{ $contareceber->total_recebido }}"
                                            class="form-campo">
                                    </div>
                                    <div class="col-3 mb-3  d-flex center-middle">
                                        <label class="text-label">Total Restante</label>
                                        <input type="text" name="valor" id="valor_original" readonly="readonly"
                                            readonly="readonly" value="{{ $contareceber->total_restante }}"
                                            class="form-campo">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <div class="caixa border radius-4">
                        <span class="p-2 py-1 bg-financeiro text-center text-uppercase h5 mb-0 text-branco">
                            Pagamentos</span>
                        <div class="tabela-responsiva">
                            <table cellpadding="0" cellspacing="0" class="table">
                                <thead>
                                    <tr>
                                        <th align="center">ID</th>
                                        <th align="left">Data</th>
                                        <th align="left">Descrição</th>
                                        <th align="center">Valor Original</th>
                                        <th align="center">Juros</th>
                                        <th align="center">Multa</th>
                                        <th align="center">Desconto</th>
                                        <th align="center">Valor Recebido</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $soma_juros = 0;
                                    $soma_multa = 0;
                                    $soma_desconto = 0;
                                    $soma_recebido = 0;
                                    ?>
                                    @foreach ($pagamentos as $i)
                                        <?php
                                        $soma_juros += $i->juros;
                                        $soma_multa += $i->multa;
                                        $soma_desconto += $i->desconto;
                                        $soma_recebido += $i->valor_recebido;
                                        ?>

                                        <tr>
                                            <td align="center">{{ $i->id }} </td>
                                            <td align="left">{{ databr($i->data_recebimento) }}</td>
                                            <td align="left">{{ $i->descricao_recebimento }}</td>
                                            <td align="center">R$ {{ $i->valor_original }}</td>
                                            <td align="center">{{ $i->juros }}</td>
                                            <td align="center">{{ $i->multa }}</td>
                                            <td align="center">{{ $i->desconto }}</td>
                                            <td align="center">R$ {{ $i->valor_recebido }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="center">{{ formataNumeroBr($soma_juros) }}</td>
                                        <td align="center">{{ formataNumeroBr($soma_multa) }}</td>
                                        <td align="center">{{ formataNumeroBr($soma_desconto) }}</td>
                                        <td align="center">R$ {{ formataNumeroBr($soma_recebido) }}</td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>


                    </div>
                </div>


            </div>
        @endsection
