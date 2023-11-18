@extends('template')
@section('conteudo')
    <div class="cat-financeiro">
        <div class="rows">

            <div class="col-12 mb-4">
                <span class=" bg-title text-light text-uppercase h5 mb-0 text-branco">
                    <svg class="icon financeiro" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 4V16M7 13.182L7.879 13.841C9.05 14.72 10.949 14.72 12.121 13.841C13.293 12.962 13.293 11.538 12.121 10.659C11.536 10.219 10.768 10 10 10C9.275 10 8.55 9.78 7.997 9.341C6.891 8.462 6.891 7.038 7.997 6.159C9.103 5.28 10.897 5.28 12.003 6.159L12.418 6.489M19 10C19 11.1819 18.7672 12.3522 18.3149 13.4442C17.8626 14.5361 17.1997 15.5282 16.364 16.364C15.5282 17.1997 14.5361 17.8626 13.4442 18.3149C12.3522 18.7672 11.1819 19 10 19C8.8181 19 7.64778 18.7672 6.55585 18.3149C5.46392 17.8626 4.47177 17.1997 3.63604 16.364C2.80031 15.5282 2.13738 14.5361 1.68508 13.4442C1.23279 12.3522 1 11.1819 1 10C1 7.61305 1.94821 5.32387 3.63604 3.63604C5.32387 1.94821 7.61305 1 10 1C12.3869 1 14.6761 1.94821 16.364 3.63604C18.0518 5.32387 19 7.61305 19 10Z"
                            stroke="#341008" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Cadastro de Conta a Pagar
                </span>
                <div class="caixa">
                    <!--   <span class="p-2 bg-title text-light text-uppercase  text-branco justify-content-space-between d-flex">

                                                            <div class="d-flex">
                                                                <a href="{{ route('contapagar.index') }}" class="btn btn-azul btn-pequeno" title="Voltar"><i
                                                                        class="fas fa-arrow-left"></i> </a>
                                                                <a href="" class="retorna btn btn-roxo btn-pequeno ml-1 d-inline-block" title="Menu"><i
                                                                        class="fas fa-bars"></i></a>
                                                            </div>
                                                        </span>-->
                    @if (isset($contapagar))
                        <form action="{{ route('contapagar.update', $contapagar->id) }}" method="POST">
                            <input name="_method" type="hidden" value="PUT" />
                        @else
                            <form action="{{ route('contapagar.store') }}" method="Post">
                    @endif
                    @csrf

                    <div class="caixa">
                        <div class="px-4 mt-3">
                            <fieldset>
                                <div class="rows pt-3 pb-4 justify-left">

                                    <div class="col-3 mb-3">
                                        <label class="text-label">Descrição da Conta a Pagar</label>
                                        <input type="text" name="descricao" required id="descricao"
                                            value="{{ $contapagar->descricao ?? old('descricao') }}" class="form-campo">
                                    </div>
                                    <div class="col-3">
                                        <label class="text-label d-block ">Fornecedor</label>
                                        <div class="grupo-form-btn">
                                            <input type="text" id="desc_fornecedor"
                                                value="{{ $contapagar->fornecedor->razao_social ?? null }}"
                                                class="form-campo">
                                            <input type="hidden" name="fornecedor_id"
                                                value="{{ $contapagar->fornecedor_id ?? null }}" id="fornecedor_id">
                                            <a href="{{ route('fornecedor.create') }}" target="_blank"
                                                class="btn btn-azul radius-50 ml-1 fas fa-plus"
                                                title="Inserir novo Fornecedor"></a>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <label class="text-label d-block text-branco">Plano de Conta </label>
                                        <select id="plano_conta_id" name="plano_conta_id" class="form-campo">
                                            <option value="">Selecione</option>
                                            @foreach ($planos as $conta)
                                                <option value="{{ $conta->id }}">{{ $conta->codigo }} -
                                                    {{ $conta->conta }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-3">
                                        <label class="text-label d-block text-branco">Centro de Custo </label>
                                        <select id="centro_custo_id" name="centro_custo_id" class="form-campo">
                                            <option value="">Selecione</option>
                                            @foreach ($centros as $c)
                                                <option value="{{ $c->id }}">{{ $c->id }} -
                                                    {{ $c->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>




                                    <div class="col-3 mb-3">
                                        <label class="text-label">Data Emissão</label>
                                        <input type="date" name="data_emissao" required id="data_emissao"
                                            value="{{ $contapagar->data_emissao ?? hoje() }}" class="form-campo">
                                    </div>


                                    <div class="col-2 mb-3">
                                        <label class="text-label">Valor</label>
                                        <input type="text" name="valor" required id="valor"
                                            value="{{ $contapagar->valor ?? old('valor') }}"
                                            class="form-campo mascara-float">
                                    </div>
                                    @if (!isset($contapagar->id))
                                        <div class="col-2">
                                            <label class="text-label d-block ">Qtd Repetição</label>
                                            <input type="number" min="1" name="qtdParcelas" required
                                                id="qtdParcelas" value="1" class="form-campo">
                                        </div>


                                        <div class="col-3 validated">
                                            <label class="text-label d-block ">Primeiro Vencimento</label>
                                            <input type="date" name="primeiro_vencimento" required value="0"
                                                id="primeiro_vencimento" class="form-campo data-input">
                                        </div>
                                    @else
                                        <div class="col-2 mb-3">
                                            <label class="text-label">Data Vencimento</label>
                                            <input type="date" name="data_vencimento" required id="data_vencimento"
                                                value="{{ $contapagar->data_vencimento ?? old('data_vencimento') }}"
                                                class="form-campo">
                                        </div>
                                    @endif
                                    <div class="col-2 text-center mt-3">
                                        <input type="hidden" name="origem" value="avulsa">
                                        <input type="submit" value="Salvar"
                                            class="btn btn-azul btn-medio d-inline-block" />

                                    </div>

                                </div>
                            </fieldset>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>




    </div>

    <script>
        $(function() {
            $("#desc_fornecedor").on("keyup", function() {
                var q = $(this).val();
                if (q == "") {
                    return;
                }
                $.ajax({
                    url: base_url + "fornecedor/pesquisa",
                    type: "GET",
                    dataType: "json",
                    data: {
                        q: q
                    },
                    success: function(data) {
                        $("#desc_fornecedor").after('<ol class="listaFornecedores"></ol>');
                        html = "";
                        for (var i in data) {
                            html +=
                                '<li><a href="javascript:;" onclick="selecionarFornecedorCompra(this)" ' +
                                'data-fornecedor_id="' + data[i].id +
                                '" data-nome_razao_social = "' + data[i].razao_social + '">' +
                                data[i].razao_social + '</a></li>'
                        }

                        $(".listaFornecedores").html(html);
                        $(".listaFornecedores").show();
                    }
                });
            })

        });

        function selecionarFornecedorCompra(obj) {
            var id = $(obj).attr('data-fornecedor_id');
            var nome = $(obj).attr('data-nome_razao_social');

            $(".listaFornecedores").hide();
            $("#fornecedor_id").val(id);
            $("#desc_fornecedor").val(nome);
        }


        function tipoBaixa() {
            var tipo = $("#id_baixa").val();
            var valor_a_pagar = $("#valor_a_pagar").val();
            if (tipo == 'T') {
                $("#valor_pago").val(valor_a_pagar);
                $("#valor_pago").attr("readonly", true);

            } else {
                $("#valor_pago").val(0);
                $("#valor_pago").attr("readonly", false);
            }
        }

        function atualizaValor() {
            var saldo_devedor = $("#saldo_devedor").val();
            var juros = $("#juros").val();
            var multa = $("#multa").val();
            var desconto = $("#desconto").val();
            console.log(juros);
            var valor_a_pagar = parseFloat(saldo_devedor) + parseFloat(juros) + parseFloat(multa) - parseFloat(desconto);
            console.log(valor_a_pagar);
            $("#valor_a_pagar").val(valor_a_pagar);
            tipoBaixa();
        }
    </script>
@endsection
