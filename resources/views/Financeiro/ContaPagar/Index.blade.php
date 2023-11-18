<?php
use App\Service\ConstanteService;
?>
@extends('template')
@section('conteudo')
    <div class="cat-financeiro">
        <div class="rows">
            <div class="col-12">
                <span class=" bg-title text-light text-uppercase h5 mb-0 text-branco">
                    <svg class="icon financeiro" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 4V16M7 13.182L7.879 13.841C9.05 14.72 10.949 14.72 12.121 13.841C13.293 12.962 13.293 11.538 12.121 10.659C11.536 10.219 10.768 10 10 10C9.275 10 8.55 9.78 7.997 9.341C6.891 8.462 6.891 7.038 7.997 6.159C9.103 5.28 10.897 5.28 12.003 6.159L12.418 6.489M19 10C19 11.1819 18.7672 12.3522 18.3149 13.4442C17.8626 14.5361 17.1997 15.5282 16.364 16.364C15.5282 17.1997 14.5361 17.8626 13.4442 18.3149C12.3522 18.7672 11.1819 19 10 19C8.8181 19 7.64778 18.7672 6.55585 18.3149C5.46392 17.8626 4.47177 17.1997 3.63604 16.364C2.80031 15.5282 2.13738 14.5361 1.68508 13.4442C1.23279 12.3522 1 11.1819 1 10C1 7.61305 1.94821 5.32387 3.63604 3.63604C5.32387 1.94821 7.61305 1 10 1C12.3869 1 14.6761 1.94821 16.364 3.63604C18.0518 5.32387 19 7.61305 19 10Z"
                            stroke="#341008" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg> Lista de Contas a Pagar
                </span>
                <div>
                </div>
                <div class="px-2 py-2 w-100 d-grid">
                    <div class="d-flex text-end">
                        <a href="{{ route('contapagar.create') }}" class="btn btn-azul d-inline-block"
                            title="Adicionar novo"><i class="fas fa-plus-circle"></i> </a>
                    </div>
                </div>
                <div class="caixafield">
                    <form action="" method="GET">
                        <div class="px-2 pt-0">
                            <div class=" bg-padrao mt-0 p-2 radius-4">
                                <div class="rows">
                                    <div class="col-3 mb-2">
                                        <label class="text-label d-block text-branco">Vencimento 01 </label>
                                        <input type="date" name="venc01" value="{{ $filtro->venc01 ?? '' }}"
                                            class="form-campo">
                                    </div>
                                    <div class="col-3 mb-2">
                                        <label class="text-label d-block text-branco">Vencimento 02 </label>
                                        <input type="date" name="venc02" value="{{ $filtro->venc02 ?? '' }}"
                                            class="form-campo">
                                    </div>
                                    <div class="col-3 mb-2">
                                        <label class="text-label d-block text-branco">Emissão 01 </label>
                                        <input type="date" name="emissao01" value="{{ $filtro->emissao01 ?? '' }}"
                                            class="form-campo">
                                    </div>
                                    <div class="col-3 mb-2">
                                        <label class="text-label d-block text-branco">Emissão 02 </label>
                                        <input type="date" name="emissao02" value="{{ $filtro->emissao02 ?? '' }}"
                                            class="form-campo">
                                    </div>
                                    @php
                                        $id_fornecedor = $filtro->fornecedor_id ?? '';
                                        $id_status = $filtro->status_id ?? '';
                                    @endphp
                                    <div class="col-4">
                                        <label class="text-label d-block text-branco">Fornecedor </label>
                                        <select name="fornecedor_id" class="form-campo">
                                            <option value="">Selecione</option>
                                            @foreach ($fornecedores as $f)
                                                <option value="{{ $f->id }}"
                                                    {{ $id_fornecedor == $f->id ? 'selected' : '' }}>{{ $f->razao_social }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-4 mb-3">
                                        <label class="text-label text-branco mb-1">Status </label>
                                        <div class="check d-flex">
                                            <label class=" d-flex text-branco text-uppercase"><input type="checkbox"
                                                    class="mr-1" name="status_id[]"
                                                    value="{{ config('constantes.status.ABERTO') }}"
                                                    {{ in_array(config('constantes.status.ABERTO'), $filtro->status_id) ? 'checked' : '' }}>
                                                ABERTO</label>
                                            <label class="ml-2 d-flex text-branco text-uppercase text-uppercase ml-6"><input
                                                    type="checkbox" class="mr-1" name="status_id[]"
                                                    value="{{ config('constantes.status.PARCIALMENTE_PAGO') }}"
                                                    {{ in_array(config('constantes.status.PARCIALMENTE_PAGO'), $filtro->status_id) ? 'checked' : '' }}>
                                                PARCIALMENTE PAGO</label>
                                            <label class="ml-2 d-flex text-branco text-uppercase text-uppercase ml-6"><input
                                                    type="checkbox" class="mr-1" name="status_id[]"
                                                    value="{{ config('constantes.status.PAGO') }}"
                                                    {{ in_array(config('constantes.status.PAGO'), $filtro->status_id) ? 'checked' : '' }}>
                                                PAGO</label>

                                        </div>
                                    </div>

                                    <div class="col-2 mb-2">
                                        <label class="text-label text-branco mb-1">&nbsp; </label>
                                        <div class="check d-flex">
                                            <label class="text-branco text-uppercase d-flex"><input type="checkbox"
                                                    class="mr-1" name="mostrar_pagto" value="S"
                                                    {{ $filtro->mostrar_pagto == 'S' ? 'checked' : '' }}> Mostrar
                                                Pagto</label>
                                        </div>
                                    </div>

                                    <div class="col-2 mt-1 pt-1">
                                        <input type="submit" value="Pesquisar"
                                            class="btn btn-azul text-uppercase width-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col">
                <div class="px-0">
                    <div class="p-1">
                        <?php //$this->verMsg();
                        ?>
                    </div>
                    <div class="tabela-responsiva pb-4 mt-3">
                        <table cellpadding="0" cellspacing="0" width="100%" id="dataTable" class="table">

                            <tbody>
                                @if ($filtro->mostrar_pagto != 'S')
                                    <tr class="thead">
                                        <th align="center">Id</th>
                                        <th class="text-left">Lançamento --</th>
                                        <th align="center">Data Emissão</th>
                                        <th align="center">Vencimento</th>
                                        <th align="center">Valor total</th>
                                        <th align="center">Fornecedor</th>
                                        <th align="center">Status</th>

                                        <th align="center">Dar Baixa</th>
                                        <th align="center">Pagamentos</th>
                                    </tr>
                                @endif
                                @foreach ($lista as $lancamento)
                                    @if ($filtro->mostrar_pagto == 'S')
                                        <tr class="thead">
                                            <th align="center">Id</th>
                                            <th class="text-left">Lançamento 444</th>
                                            <th align="center">Data Emissão</th>
                                            <th align="center">Vencimento</th>
                                            <th align="center">Valor total</th>
                                            <th align="center">Fornecedor</th>
                                            <th align="center">Status</th>
                                            <th align="center">Dar Baixa</th>
                                            <th align="center">Pagamentos</th>
                                        </tr>
                                    @endif
                                    <tr class="thead">
                                        <td align="center">{{ $lancamento->id }}</td>
                                        <td align="left">{{ $lancamento->descricao }} <small
                                                class="d-block text-azul">{{ $lancamento->fornecedor->razao_social ?? 'Sistema' }}
                                                <b class="qtd">{{ $lancamento->num_parcela }} /
                                                    {{ $lancamento->ult_parcela }} </b></small></td>
                                        <td align="center">{{ databr($lancamento->data_emissao) }}</td>
                                        <td align="center">{{ databr($lancamento->data_vencimento) }}</td>
                                        <td align="center">{{ formataNumeroBr($lancamento->valor) }}</td>
                                        <td align="center">{{ $lancamento->fornecedor->razao_social ?? 'Sistema' }}</td>
                                        <td align="center"><span
                                                class="{{ strtolower($lancamento->status->status) }}">{{ $lancamento->status->status }}</span>
                                        </td>

                                        <td align="center">
                                            <a href="{{ route('contapagar.confirmarPagamento', $lancamento->id) }}"
                                                class="d-inline-block btn btn-roxo btn-pequeno">Dar
                                                Baixa</a>
                                        </td>

                                        <td align="center">
                                            <a href="" class="d-inline-block btn btn-verde btn-pequeno">
                                                Pagamentos</a>
                                        </td>

                                        @if (count($lancamento->pagamentos) > 0)
                                            @if ($filtro->mostrar_pagto == 'S')
                                    <tr class="thead">
                                        <td colspan="8" class="" align="center">
                                            <table cellpadding="0" cellspacing="0"
                                                class="table table-bordered menor fatura m-auto" style="width:95%">
                                                <thead>
                                                    <tr>
                                                        <th align="left" colspan="11"
                                                            style="border-top:0;padding-top:0.55rem;padding-bottom:.55rem">
                                                            <span class="h6 mb-0 text-left text-uppercase"><i
                                                                    class="fas fa-hand-holding-usd"></i> Lista de
                                                                pagamentos</span>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th align="center">Id</th>
                                                        <th class="text-left">Descrição11</th>
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

                                                    @foreach ($lancamento->pagamentos as $pag)
                                                        <tr>
                                                            <td align="center">{{ $pag->id }}</td>
                                                            <td align="left">{{ $pag->descricao_pagamento }} </td>
                                                            <td align="center">{{ databr($pag->data_pagamento) }}</td>
                                                            <td align="center">{{ $pag->numero_documento }}</td>
                                                            <td align="center">{{ formataNumeroBr($pag->valor_original) }}
                                                            </td>
                                                            <td align="center">{{ formataNumeroBr($pag->juros) }}</td>
                                                            <td align="center">{{ formataNumeroBr($pag->desconto) }}</td>
                                                            <td align="center">{{ formataNumeroBr($pag->multa) }}</td>
                                                            <td align="center">{{ formataNumeroBr($pag->valor_pago) }}
                                                            </td>
                                                            <td align="center">{{ $pag->forma_pagto->forma_pagto }}</td>
                                                            <td align="center">
                                                                <a href="{{ route('pagamento.show', $pag->id) }}"
                                                                    class="btn btn-roxo d-inline-block"><i
                                                                        class="fas fa-eye" title="Visualizar"></i></a>

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


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="d-none col-2 MostraOpcoes sm-mx" id="opcoes_pagar">

                <ul class="cx-opcoes">
                    <li class="titulo bg-padrao text-branco d-flex center-middle justify-content-space-between">
                        <span>Opções: <span id="id_pagar"></span> </span>
                        <a href="javascript:;" onClick="fechar_opcoes_pagar()" title="Fechar Opções"
                            class="text-vermelho position-inherit p-0"><i class="fas fa-times position-inherit"></i></a>
                    </li>
                    <li><a href="javascript:;" onclick="verEdicao()" class="" title="Editar "><i
                                class="fas fa-edit"></i> Editar</a></li>
                    <li><a href="javascript:;" onClick="confirmarPagamento()" title="Confirmar Pagamento"><i
                                class="fas fa-eye"></i> Confirmar Pagamento</a></li>
                    <li><a href="javascript:;" onclick="verDetalhe()" class="" title="Detalhes "><i
                                class="fas fa-edit"></i> Detalhes</a></li>
                    <li><a href="javascript:;" onclick="excluir()"><i class="fas fa-trash-alt"></i> Excluir</a></li>

                </ul>
            </div>

        </div>
    </div>

    <script>
        var pagar_id = 0;

        function pesquisar(mes) {
            var ano = $("#ano").val();
            window.location.href = base_url + "contapagar/pormes/?ano=" + ano + "&mes=" + mes;
        }

        function abrir_opcoes_pagar(id) {
            pagar_id = id;
            $("#id_pagar").html(id);
            mostrar_opcoes('opcoes_pagar')
        }

        function fechar_opcoes_pagar() {
            esconder_opcoes('opcoes_pagar');
        }

        function confirmarPagamento() {
            giraGira();
            location.href = base_url + "contapagar/confirmarPagamento/" + pagar_id;
        }

        function verDetalhe() {
            giraGira();
            location.href = base_url + "contapagar/detalhe/" + pagar_id;
        }

        function verEdicao() {
            giraGira();
            location.href = base_url + "contapagar/" + pagar_id + "/edit";
        }

        function excluir() {
            if (confirm('Tem Certeza?')) {
                $.ajax({
                    url: base_url + "contapagar/" + pagar_id,
                    type: "DELETE",
                    dataType: "Json",
                    data: {},
                    success: function(data) {
                        fecharGiraGira(0);
                        location.reload();

                    },
                    beforeSend: function() {
                        giraGira();
                    }

                });
            }
        }

        function abrirDuplicata() {
            window.location.href = base_url + "contapagar/duplicata";
        }
    </script>
@endsection
