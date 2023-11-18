function buscarCNPJ(){
    var cnpj = tira_mascara($("#codigocnpj").val());
    $.ajax({
        url:base_url + "util/buscarcnpj/" + cnpj,
        type:"GET",
        dataType:"JSON",
        data:{},
        success:function(data){
            fecharModal();
            if(data.tem_erro==true){
                $("#mostrarUmErro").html(MostrarUmaMsgErro("Erro: " +  data.erro));
            }else{
                preencherDadosTransportadora(data.retorno);
            }
        },
        error:function(data){

        }

    });
}

function preencherDadosTransportadora(data){
	$("#razao_social").val(data.razao_social);
	$("#nome_fantasia").val(data.nome_fantasia);
	$("#numero").val(data.numero);
	$("#bairro").val(data.bairro);
	$("#complemento").val(data.complemento);
	$("#cnpj").val(data.cnpj);
	$("#cep").val(data.cep);
	$("#logradouro").val(data.logradouro);
	$("#cidade").val(data.cidade);
	$("#bairro").val(data.bairro);
	$("#uf").val(data.uf);
	$("#ibge").val(data.ibge);
	$("#email").val(data.email);
	$("#ultima_atualizacao").val(data.ultima_atualizacao);
	$("#data_criacao").val(data.abertura)
}
