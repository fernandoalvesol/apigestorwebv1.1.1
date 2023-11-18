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
                Lista de Centro de Custo
            </span>

            <div class="caixa">

                <div class="px-2 py-2 w-100 d-grid">
                    @if (isset($despesafixa))
                        <form action="{{ route('despesafixa.update', $despesafixa->id) }}" method="POST">
                            @method('put')
                        @else
                            <form action="{{ route('despesafixa.store') }}" method="POST">
                    @endif
                    @csrf
                    <div class="{{ isset($despesafixa->descricao) ? 'bg-edit' : 'caixafield' }}  p-2 radius-4 border">
                        <div class="   p-2 pt-0 radius-4">
                            <div class="rows center-middle">
                                <div class="col-3">
                                    <label class="text-label d-block text-branco">Plano de Conta </label>
                                    <select id="plano_conta_id" name="plano_conta_id" class="form-campo">
                                        <option value="">Selecione</option>
                                        @foreach ($planos as $conta)
                                            <option value="{{ $conta->id }}">{{ $conta->codigo }} - {{ $conta->conta }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="text-label d-block text-branco">Fornecedor </label>
                                    <select id="fornecedor_id" name="fornecedor_id" class="form-campo">
                                        <option value="">Selecione</option>
                                        @foreach ($fornecedores as $f)
                                            <option value="{{ $f->id }}">{{ $f->id }} - {{ $f->razao_social }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-3">
                                    <label class="text-label d-block text-branco">Centro de Custo </label>
                                    <select id="centro_custo_id" name="centro_custo_id" class="form-campo">
                                        <option value="">Selecione</option>
                                        @foreach ($centros as $c)
                                            <option value="{{ $c->id }}">{{ $c->id }} - {{ $c->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-3">
                                    <label class="text-label d-block text-branco">Conta Corrente </label>
                                    <select id="conta_corrente_id" name="conta_corrente_id" class="form-campo">
                                        <option value="">Selecione</option>
                                        @foreach ($contas as $co)
                                            <option value="{{ $co->id }}">{{ $co->id }} -
                                                {{ $co->descricao }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-3">
                                    <label class="text-label d-block text-branco">Forma de Pagamento </label>
                                    <select id="forma_pagto_id" name="forma_pagto_id" class="form-campo">
                                        <option value="">Selecione</option>
                                        @foreach ($formas as $fo)
                                            <option value="{{ $fo->id }}">{{ $fo->id }} -
                                                {{ $fo->forma_pagto }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-3">
                                    <label class="text-label d-block text-branco">Descrição </label>
                                    <input type="text" name="descricao" required
                                        value="{{ $despesafixa->descricao ?? old('descricao') }}" class="form-campo">
                                </div>
                                <div class="col-2">
                                    <label class="text-label d-block text-branco">Dia Vcto </label>
                                    <input type="number" name="dia_vencimento" required
                                        value="{{ $despesafixa->dia_vencimento ?? old('dia_vencimento') }}"
                                        class="form-campo">
                                </div>
                                <div class="col-2">
                                    <label class="text-label d-block text-branco">Valor </label>
                                    <input type="text" name="valor" value="{{ $despesafixa->valor ?? old('valor') }}"
                                        required class="form-campo mascara-float">
                                </div>

                                <div class="col-2 mt-0 pt-4">
                                    <input type="submit" value="Salvar" class="w-100 btn btn-roxo text-uppercase">
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="col-12">
            <div class="px-2">
                <div class="tabela-responsiva pb-4">
                    <table cellpadding="0" cellspacing="0" id="dataTable" width="100%" class="table despesafixa">
                        <thead>
                            <tr>
                                <th align="center">Id</th>
                                <th align="left">Descrição</th>
                                <th align="left">Dia Vcto</th>
                                <th align="left">Valor</th>
                                <th align="left">Plano de Conta</th>
                                <th align="left">Forma Pagto</th>
                                <th align="center">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lista as $l)
                                <tr>
                                    <td align="center">{{ $l->id }}</td>
                                    <td align="left">{{ $l->descricao }}</td>
                                    <td align="left">{{ $l->dia_vencimento }}</td>
                                    <td align="left">{{ $l->valor }}</td>
                                    <td align="left">{{ $l->planoconta->conta ?? null }}</td>
                                    <td align="left">{{ $l->forma_pagto->forma_pagto ?? null }}</td>
                                    <td align="center">
                                        <a href="{{ route('despesafixa.edit', $l->id) }}"
                                            class="d-inline-block btn btn-outline-roxo btn-pequeno"><i
                                                class="fas fa-edit"></i>
                                            Editar</a>

                                        <a href="javascript:;"
                                            onclick="confirm('Tem Certeza?') ? document.getElementById('apagar{{ $l->id }}').submit() : '';"
                                            class="d-inline-block btn btn-outline-vermelho btn-pequeno">
                                            <i class="fas fa-trash-alt"></i>
                                            <form action="{{ route('despesafixa.destroy', $l->id) }}" method="POST"
                                                id="apagar{{ $l->id }}">
                                                @method('DELETE')
                                                @csrf
                                            </form>

                                            Excluir
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>


            <!--
                                                                                                                                                                                                                                                                                            <div class="caixa p-2">
                                                                                                                                                                                                                                                                                                    <div class="msg msg-verde">
                                                                                                                                                                                                                                                                                                    <p><b><i class="fas fa-check"></i> Mensagem de boas vindas</b> Parabéns seu produto foi inserido com sucesso</p>
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                    <div class="msg msg-vermelho">
                                                                                                                                                                                                                                                                                                    <p><b><i class="fas fa-times"></i> Mensagem de Erro</b> Houve um erro</p>
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                    <div class="msg msg-amarelo">
                                                                                                                                                                                                                                                                                                    <p><b><i class="fas fa-exclamation-triangle"></i> Mensagem de aviso</b> Tem um aviso pra você</p>
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                            -->
        </div>

    </div>
@endsection
