@extends('template')
@section('conteudo')
    <div class="rows cat-financeiro">
        <div class="col-12">
            <span class=" bg-title text-light text-uppercase h5 mb-0 text-branco">
                <svg class="icon financeiro" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 4V16M7 13.182L7.879 13.841C9.05 14.72 10.949 14.72 12.121 13.841C13.293 12.962 13.293 11.538 12.121 10.659C11.536 10.219 10.768 10 10 10C9.275 10 8.55 9.78 7.997 9.341C6.891 8.462 6.891 7.038 7.997 6.159C9.103 5.28 10.897 5.28 12.003 6.159L12.418 6.489M19 10C19 11.1819 18.7672 12.3522 18.3149 13.4442C17.8626 14.5361 17.1997 15.5282 16.364 16.364C15.5282 17.1997 14.5361 17.8626 13.4442 18.3149C12.3522 18.7672 11.1819 19 10 19C8.8181 19 7.64778 18.7672 6.55585 18.3149C5.46392 17.8626 4.47177 17.1997 3.63604 16.364C2.80031 15.5282 2.13738 14.5361 1.68508 13.4442C1.23279 12.3522 1 11.1819 1 10C1 7.61305 1.94821 5.32387 3.63604 3.63604C5.32387 1.94821 7.61305 1 10 1C12.3869 1 14.6761 1.94821 16.364 3.63604C18.0518 5.32387 19 7.61305 19 10Z"
                        stroke="#341008" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                Contas a receber
            </span>
            <div class="px-2 py-2 w-100 d-grid">
                <div class="d-flex text-end">
                    <a href="{{ route('contareceber.create') }}" class="btn btn-azul d-inline-block"
                        title="Adicionar novo"><i class="fas fa-plus-circle"></i> </a>
                </div>
            </div>

            <div class="caixa">

                <div class="rows">
                    <div class="col-12 mb-4">
                        <div class="px-2">
                            <div class="caixafield mt-2 p-2 radius-4 border">
                                <div class="rows center-middle">
                                    <div class="col-2 mb-3">
                                        <span class="text-label">Data 1</span>
                                        <input type="date" name="" class="form-campo">
                                    </div>
                                    <div class="col-2 mb-3">
                                        <span class="text-label">Data 2</span>
                                        <input type="date" name="" class="form-campo">
                                    </div>
                                    <div class="col-3 mb-3">
                                        <span class="text-label">Status da venda</span>
                                        <input type="date" name="" class="form-campo">
                                    </div>
                                    <div class="col-3 mb-3">
                                        <span class="text-label">Status financeiro</span>
                                        <input type="date" name="" class="form-campo">
                                    </div>
                                    <div class="col-2 mb-3 mt-4">
                                        <input type="submit" value="Pesquisa" class="btn btn-azul w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-12">
            <div class="px-2">
                <div class="tabela-responsiva pb-4">
                    <table cellpadding="0" cellspacing="0" id="dataTable" width="100%" class="table categoria">
                        <tbody>
                            <?php
                            $valor_original = 0;
                            $total_recebido = 0;
                            $total_restante = 0;
                            $total_juros = 0;
                            $total_multa = 0;
                            $total_desconto = 0;
                            $total_liquido = 0;
                            
                            ?>

                            @if ($filtro->mostrar_pagto != 'S')
                                <tr class="thead">
                                    <th align="center">Id</th>
                                    <th class="text-left">Descrição</th>
                                    <th align="center">Data Emissão</th>
                                    <th align="center">Vencimento</th>
                                    <th align="center">Previsão Pagto</th>
                                    <th align="center">Valor Original</th>
                                    <th align="center">Total Recebido</th>
                                    <th align="center">Total Restante</th>
                                    <th align="center">Juros</th>
                                    <th align="center">Multa</th>
                                    <th align="center">Desconto</th>
                                    <th align="center">Líquido</th>
                                    <th align="center">Status</th>
                                    <th align="center">Dar Baixa</th>
                                    <th align="center">Pagamentos</th>
                                </tr>
                            @endif


                            @foreach ($lista as $lancamento)
                                <?php
                                $valor_original += $lancamento->valor;
                                $total_recebido += $lancamento->total_recebido;
                                $total_restante += $lancamento->total_restante;
                                $total_juros += $lancamento->total_juros;
                                $total_multa += $lancamento->total_multa;
                                $total_desconto += $lancamento->total_desconto;
                                $total_liquido += $lancamento->total_liquido;
                                
                                ?>
                                @if ($filtro->mostrar_pagto == 'S')
                                    <tr class="thead">
                                        <th align="center">Id</th>
                                        <th class="text-left">Descrição</th>
                                        <th align="center">Data Emissão</th>
                                        <th align="center">Vencimento</th>
                                        <th align="center">Previsão Pagto</th>
                                        <th align="center">Valor Original</th>
                                        <th align="center">Total Recebido</th>
                                        <th align="center">Total Restante</th>
                                        <th align="center">Juros</th>
                                        <th align="center">Multa</th>
                                        <th align="center">Desconto</th>
                                        <th align="center">Líquido</th>
                                        <th align="center" colspan="3">Status</th>
                                    </tr>
                                @endif
                                <tr class="caixafield">
                                    <td align="center">{{ $lancamento->id }}</td>
                                    <td align="left">{{ $lancamento->descricao }} <small
                                            class="d-block text-azul text-uppercase">{{ $lancamento->cliente->nome_razao_social }}
                                            <b class="qtd">{{ $lancamento->num_parcela }} /
                                                {{ $lancamento->ult_parcela }} </b></small></td>
                                    <td align="center">{{ databr($lancamento->data_emissao) }}</td>
                                    <td align="center">{{ databr($lancamento->data_vencimento) }}</td>
                                    <td align="center">
                                        {{ $lancamento->data_previsao ? databr($lancamento->data_previsao) : '--' }}</td>
                                    <td align="center">{{ $lancamento->valor }}</td>
                                    <td align="center">{{ $lancamento->total_recebido }}</td>
                                    <td align="center">{{ $lancamento->total_restante }}</td>
                                    <td align="center">{{ $lancamento->total_juros }}</td>
                                    <td align="center">{{ $lancamento->total_multa }}</td>
                                    <td align="center">{{ $lancamento->total_desconto }}</td>
                                    <td align="center">{{ $lancamento->total_liquido }}</td>

                                    <td align="center"><span
                                            class="{{ strtolower($lancamento->status->status ?? null) }}">{{ $lancamento->status->status ?? null }}</span>
                                    </td>
                                    <td align="center">
                                        <a href="{{ route('contareceber.darBaixa', $lancamento->id) }}"
                                            class="d-inline-block btn btn-roxo btn-pequeno">Dar Baixa</a>
                                    </td>

                                    <td align="center">
                                        <a href="{{ route('contareceber.detalhe', $lancamento->id) }}"
                                            class="d-inline-block btn btn-verde btn-pequeno"> Pagamentos</a>
                                    </td>


                                    @if (count($lancamento->recebimentos) > 0)
                                        @if ($filtro->mostrar_pagto == 'S')
                                <tr class="thead">
                                    <td colspan="15" class="p-1">
                                        <table cellpadding="0" cellspacing="0" class="table border menor fatura"
                                            style="width: 94%!important;  margin-left: 4rem;">
                                            <thead>
                                                <tr class="d-none">
                                                    <th align="center" colspan="11"
                                                        style="border-top:0;padding-top:0.55rem;padding-bottom:.55rem">
                                                        <span class="h6 mb-0 text-center text-uppercase"><i
                                                                class="fas fa-hand-holding-usd"></i> Lista de
                                                            pagamentos</span>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th align="center">Id</th>
                                                    <th class="text-left">Descrição</th>
                                                    <th align="center">Data Recebimento</th>
                                                    <th align="center">Número</th>
                                                    <th align="center">Valor Original</th>
                                                    <th align="center">Juros</th>
                                                    <th align="center">Desconto</th>
                                                    <th align="center">Multa</th>
                                                    <th align="center">Valor Recebido</th>
                                                    <th align="center">Forma Pagto</th>
                                                    <th align="center">Opções</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($lancamento->recebimentos as $rec)
                                                    <tr class="">
                                                        <td align="center">{{ $rec->id }}</td>
                                                        <td align="left">{{ $rec->descricao_recebimento }} </td>
                                                        <td align="center">{{ databr($rec->data_recebimento) }}</td>
                                                        <td align="center">{{ $rec->numero_documento }}</td>
                                                        <td align="center">{{ $rec->valor_original }}</td>
                                                        <td align="center">{{ $rec->juros }}</td>
                                                        <td align="center">{{ $rec->desconto }}</td>
                                                        <td align="center">{{ $rec->multa }}</td>
                                                        <td align="center">{{ $rec->valor_recebido }}</td>
                                                        <td align="center">
                                                            {{ $rec->forma_pagamento ? $rec->forma_pagamento->forma_pagto : '--' }}
                                                        </td>
                                                        <td align="center">
                                                            <a href="{{ route('recebimento.show', $rec->id) }}"
                                                                class="btn btn-roxo d-inline-block"><i class="fas fa-eye"
                                                                    title="Visualizar"></i></a>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            @endif
                            @endif

                            </tr>
                            @endforeach




                            <tr class="total">
                                <td align="right" colspan="7" class="border-top text-uppercase"><b>Totais</b>
                                </td>
                                <td align="center" class="border-top py-1">{{ formataNumeroBr($valor_original) }}</td>
                                <td align="center" class="border-top py-1">{{ formataNumeroBr($total_recebido) }}</td>
                                <td align="center" class="border-top py-1">{{ formataNumeroBr($total_restante) }}</td>
                                <td align="center" class="border-top py-1">{{ formataNumeroBr($total_juros) }}</td>
                                <td align="center" class="border-top py-1">{{ formataNumeroBr($total_multa) }}</td>
                                <td align="center" class="border-top py-1">{{ formataNumeroBr($total_desconto) }}</td>
                                <td align="center" class="border-top py-1">{{ formataNumeroBr($total_liquido) }}</td>
                                <td align="left" colspan="2" class="border-top"></td>

                            </tr>
                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>
@endsection
