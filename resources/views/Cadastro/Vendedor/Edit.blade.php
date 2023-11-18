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
                CADASTRAR VENDEDOR
            </span>
        </div>

        <div class="col-12">

            <div id="tab">

                <form action="{{ route('vendedor.update', $vendedor->id) }}" method="post">
                    @method('put')
                    @csrf


                    <div id="tab-1">
                        <div class="p-2">
                            <span class="d-block mt-0 mb-4 border-bottom text-uppercase pb-1">Informações básicas</span>
                            <div class="rows">
                                <div class="col-6 mb-3">
                                    <label class="text-label" id="lblRazaoSocial">nome<span
                                            class="text-vermelho">*</span></label>
                                    <input type="text" name="nome" id="nome" required
                                        value="{{ old('nome') ?? $vendedor->nome }}" class="form-campo">
                                </div>

                                <div class="col-4 mb-3">
                                    <label class="text-label id="lblCpf">CPF<span class="text-vermelho">*</span></label>
                                    <input type="text" name="cpf" id="cpf"
                                        value="{{ old('cpf') ?? $vendedor->cpf }}" class="form-campo">
                                </div>



                                <div class="col-2 mb-3">
                                    <label class="text-label" id="lblInscEstadual">RG</label>
                                    <input type="text" name="rg" maxlength="14" id="rg"
                                        value="{{ old('rg') ?? $vendedor->rg }}" class="form-campo">
                                </div>
                                <div class="col-4 mb-3">
                                    <label class="text-label">Celular:</label>
                                    <input type="text" name="celular" value="{{ old('celular') ?? $vendedor->celular }}"
                                        class="form-campo mascara-celular">
                                </div>

                                <div class="col-8 mb-3">
                                    <label class="text-label">Email</label>
                                    <input type="email" name="email" value="{{ old('email') ?? $vendedor->email }}"
                                        class="form-campo">
                                </div>



                            </div>
                        </div>
                    </div>

                    <div id="tab-2">
                        <div class="p-2">
                            <span class="d-block mt-4 mb-4 border-bottom text-uppercase pb-1">Endereço</span>
                            <div class="rows">
                                <div class="col-2 mb-3">
                                    <label class="text-label">CEP</label>
                                    <div class="input-grupo">
                                        <input type="text" value="{{ old('cep') ?? $vendedor->cep }}" name="cep"
                                            id="cep" class="form-campo busca_cep mascara-cep">

                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="text-label">Logradouro</label>
                                    <input type="text" name="logradouro" id="logradouro"
                                        value="{{ old('logradouro') ?? $vendedor->logradouro }}" class="form-campo rua">
                                </div>
                                <div class="col-2 mb-4">
                                    <label class="text-label">Numero</label>
                                    <input type="text" name="numero" id="numero"
                                        value="{{ old('numero') ?? $vendedor->numero }}" class="form-campo ">
                                </div>
                                <div class="col-2 mb-2">
                                    <label class="text-label">UF</label>
                                    <input type="text" name="uf" id="uf"
                                        value="{{ old('uf') ?? $vendedor->uf }}" class="form-campo estado">
                                </div>
                                <div class="col-3 mb-3">
                                    <label class="text-label">Complemento</label>
                                    <input type="text" name="complemento" id="complemento"
                                        value="{{ old('complemento') ?? $vendedor->complemento }}" class="form-campo">
                                </div>
                                <div class="col-3 mb-3">
                                    <label class="text-label">Bairro</label>
                                    <input type="text" name="bairro" id="bairro"
                                        value="{{ old('bairro') ?? $vendedor->bairro }}" class="form-campo bairro ">
                                </div>

                                <div class="col-4 mb-2">
                                    <label class="text-label">Cidade</label>
                                    <input type="text" name="cidade" id="cidade"
                                        value="{{ old('cidade') ?? $vendedor->cidade }}" class="form-campo cidade">
                                </div>
                                <div class="col-2 mb-2">
                                    <label class="text-label">IBGE</label>
                                    <input type="text" name="ibge" id="ibge"
                                        value="{{ old('ibge') ?? $vendedor->ibge }}" class="form-campo ibge">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-12 text-center pb-4">
                        <input type="submit" value="Salvar" class="btn btn-padrao m-auto">
                    </div>
                </form>
            </div>
        </div>


    </div>
    <script>
        function tipoVendedor() {
            var tp = $("#tipo_vendedor").val();

            if (tp == "F") {
                $("#div_pesquisar").hide();
                $("#divIscEstadual").hide();
                $("#divSuframa").hide();
                $("#divFantasia").hide();

                $("#lblInscEstadual").html("RG");
                $("#lblCpf").html('CPF');
                $("#lblRazaoSocial").html('Nome');
                $("#cpf").mask('000.000.000-00', {
                    reverse: true
                });
                $("#indFinal option:contains(Sim)").attr('selected', true);
                $("#tipo_contribuinte option:contains(Não)").attr('selected', true);
            } else {
                $("#div_pesquisar").show();
                $("#divIscEstadual").show();
                $("#divSuframa").show();
                $("#divFantasia").show();

                $("#lblInscEstadual").html("Inscrição Estadual");
                $("#lblCpf").html('CPF');
                $("#lblRazaoSocial").html('Razão Social');
                $("#cpf").mask('00.000.000/0000-00', {
                    reverse: true
                });

                $("#lblCpf").html('CPF');
                $("#indFinal option:contains(Não)").attr('selected', true);
                $("#tipo_contribuinte option:contains(ICMS)").attr('selected', true);

            }
        }
    </script>
@endSection
