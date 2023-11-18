<?php
use App\Service\ConstanteService;
?>
@extends('template')
@section('conteudo')
    <div class="cat-financeiro">
        <div class="rows">
            <div class="col-12">
                <div
                    class="p-2 py-1 bg-title text-light text-uppercase h4 mb-0 text-branco d-flex justify-content-space-between">
                    <span class="d-flex center-middle"><i class="far fa-list-alt mr-1"></i> Lista de Pagamentos </span>
                    <div>
                    </div>
                </div>
                <div class="caixafield">
                    <form action="{{ route('pagamento.filtro') }}" method="GET">
                        <div class="px-2 pt-0">
                            <div class="bg-padrao mt-0 p-2 radius-4">
                                <div class="rows center-middle">

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


                                    <div class="col-3">
                                        <label class="text-label d-block text-branco">Forma Pagto </label>
                                        <select name="forma_pagto_id" class="form-campo">
                                            <option value="">Selecione</option>
                                            @foreach ($formas as $f)
                                                <option value="{{ $f->id }}"
                                                    {{ $id_forma == $f->id ? 'selected' : '' }}>{{ $f->forma_pagto }}
                                                </option>
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
                <div class="px-0">
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
                                    <th align="center">Data Pagamento</th>
                                    <th align="center">Número</th>
                                    <th align="center">Valor Original</th>
                                    <th align="center">Juros</th>
                                    <th align="center">Desconto</th>
                                    <th align="center">Multa</th>
                                    <th align="center">Valor Pago</th>
                                    <th align="center">Forma Pagto</th>
                                    <th align="center">Opções</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($lista as $lancamento)
                                    <tr>
                                        <td align="center">{{ $lancamento->id }}</td>
                                        <td align="left">{{ $lancamento->descricao_pagamento }} </td>
                                        <td align="center">{{ databr($lancamento->data_pagamento) }}</td>
                                        <td align="center">{{ $lancamento->numero_documento }}</td>
                                        <td align="center">{{ formataNumeroBr($lancamento->valor_original) }}</td>
                                        <td align="center">{{ formataNumeroBr($lancamento->juros) }}</td>
                                        <td align="center">{{ formataNumeroBr($lancamento->desconto) }}</td>
                                        <td align="center">{{ formataNumeroBr($lancamento->multa) }}</td>
                                        <td align="center">{{ formataNumeroBr($lancamento->valor_pago) }}</td>
                                        <td align="center">{{ $lancamento->forma_pagto->forma_pagto }}</td>
                                        <td align="center">
                                            <a href="{{ route('pagamento.show', $lancamento->id) }}"
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
    </div>
    <script>
        function pesquisar(mes) {
            var ano = $("#ano").val();
            window.location.href = base_url + "admin/pagamento/pormes/?ano=" + ano + "&mes=" + mes;
        }
    </script>
@endsection
