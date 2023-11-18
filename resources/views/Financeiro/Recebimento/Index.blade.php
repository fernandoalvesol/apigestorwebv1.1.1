@extends('template')
@section('conteudo')
    <div class="rows cat-financeiro">
        <div class="col-12">
            <div class="caixa">
                <span class=" bg-title text-light text-uppercase h5 mb-0 text-branco">
                    <svg class="icon financeiro" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 4V16M7 13.182L7.879 13.841C9.05 14.72 10.949 14.72 12.121 13.841C13.293 12.962 13.293 11.538 12.121 10.659C11.536 10.219 10.768 10 10 10C9.275 10 8.55 9.78 7.997 9.341C6.891 8.462 6.891 7.038 7.997 6.159C9.103 5.28 10.897 5.28 12.003 6.159L12.418 6.489M19 10C19 11.1819 18.7672 12.3522 18.3149 13.4442C17.8626 14.5361 17.1997 15.5282 16.364 16.364C15.5282 17.1997 14.5361 17.8626 13.4442 18.3149C12.3522 18.7672 11.1819 19 10 19C8.8181 19 7.64778 18.7672 6.55585 18.3149C5.46392 17.8626 4.47177 17.1997 3.63604 16.364C2.80031 15.5282 2.13738 14.5361 1.68508 13.4442C1.23279 12.3522 1 11.1819 1 10C1 7.61305 1.94821 5.32387 3.63604 3.63604C5.32387 1.94821 7.61305 1 10 1C12.3869 1 14.6761 1.94821 16.364 3.63604C18.0518 5.32387 19 7.61305 19 10Z"
                            stroke="#341008" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Lista de recebimentos
                </span>

                <form action="{{ route('recebimento.index') }}" method="GET">
                    <div class="px-2 pt-2">
                        <div class=" caixafield mt-2 p-2 radius-4">
                            <div class="rows">
                                <div class="col-3">
                                    <label class="text-label d-block text-branco">Data 01 </label>
                                    <input type="date" name="data01" value="{{ $filtro->data01 ?? '' }}"
                                        class="form-campo">
                                </div>
                                <div class="col-3">
                                    <label class="text-label d-block text-branco">Data 02 </label>
                                    <input type="date" name="data02" value="{{ $filtro->data02 ?? '' }}"
                                        class="form-campo">
                                </div>

                                @php
                                    $id_forma = $filtro->forma_pagto_id ?? '';
                                @endphp


                                <div class="col-4">
                                    <label class="text-label d-block text-branco">Forma Pagto </label>
                                    <select name="forma_pagto_id" class="form-campo">
                                        <option value="">Selecione</option>
                                        @foreach ($formas as $f)
                                            <option value="{{ $f->id }}" {{ $id_forma == $f->id ? 'selected' : '' }}>
                                                {{ $f->forma_pagto }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2 mt-4">
                                    <input type="submit" value="Pesquisar" class="btn btn-azul text-uppercase">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="col-12">
            <div class="px-2">
                <div class="p-1">
                    <?php //$this->verMsg();
                    ?>
                </div>
                <div class="tabela-responsiva pb-4 mt-3">
                    <table cellpadding="0" cellspacing="0" width="100%" id="dataTable" class="table">
                        <thead>
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
                            @foreach ($lista as $lancamento)
                                <tr>
                                    <td align="center">{{ $lancamento->id }}</td>
                                    <td align="left">{{ $lancamento->descricao_recebimento }} </td>
                                    <td align="center">{{ databr($lancamento->data_recebimento) }}</td>
                                    <td align="center">{{ $lancamento->numero_documento }}</td>
                                    <td align="center">{{ $lancamento->valor_original }}</td>
                                    <td align="center">{{ $lancamento->juros }}</td>
                                    <td align="center">{{ $lancamento->desconto }}</td>
                                    <td align="center">{{ $lancamento->multa }}</td>
                                    <td align="center">{{ $lancamento->valor_recebido }}</td>
                                    <td align="center">
                                        {{ $lancamento->forma_pagamento ? $lancamento->forma_pagamento->forma_pagto : '--' }}
                                    </td>
                                    <td align="center">
                                        <a href="{{ route('recebimento.show', $lancamento->id) }}"
                                            class="btn btn-roxo d-inline-block"><i class="fas fa-eye"
                                                title="Visualizar"></i></a>

                                    </td>
                                </tr>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection
