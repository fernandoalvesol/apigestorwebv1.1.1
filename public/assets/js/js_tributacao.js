$("#btnInserirIvaTributacao").on("click", function(){
    var natureza_operacao_id		= $(".natureza_operacao_id").val();
    var tributacao_id			    = $(".tributacao_id").val();

    if(natureza_operacao_id==""){
        alert("Selecionar a natureza de operação primeiramente");
        return;
    }

    if(tributacao_id==""){
        alert("Selecionar a tributação primeiramente");
        return;
    }
    $.ajax({
       url: base_url + "tributacaoiva",
       type: "POST",
       dataType: "json",
       data:$("#frmCadIva").serialize(),
         success: function(data){
             lista_iva_tributacao(data);
             limpar_iva_tributacao();
         }

    });
});

$("#nomeProduto").on("keyup", function(){
    var q = $(this).val();
    if(q==""){
        return;
    }
    $.ajax({
        url: base_url + "produto/pesquisa",
        type: "GET",
        dataType: "json",
        data: {q:q},
        success: function (data){
            $("#nomeProduto").after('<div class="listaProdutos"></div>');
            html="";
            for(var i in data){
                html +='<div class="si"><a href="javascript:;" onclick="selecionarProdutoTributacao(this)" ' +
                          'data-id="'+data[i].id +
                          '" data-nome = "' + data[i].nome + '">' +  data[i].id + " -  " + data[i].nome + '</a></div>';
            }

            $(".listaProdutos").html(html);
            $(".listaProdutos").show();
        }
    });
});

function abrirTelaIva(tributacao_id, natureza_id) {
    $(".tributacao_id").val(tributacao_id);
    $(".natureza_operacao_id").val(natureza_id);

    $.ajax({
        url: base_url + "tributacaoiva/listaPorTributacao/"  + tributacao_id,
        type: "GET",
        dataType: "json",
        data:{},
          success: function(data){
              lista_iva_tributacao(data);
          }
     });
    abrirModal('#telaIva')
}

function lista_iva_tributacao(data){
	html = "<tr>";
	for(var i in data){
		html += '<td align="center">' + data[i].id + '</td>' +
        '<td align="left">' + data[i].uf_origem + '</td>' +
		'<td align="left">' + data[i].uf_destino + '</td>' +
		'<td align="left">' + data[i].cstIcms + '</td>' +
		'<td align="left">' + data[i].pIcmsIntra + '</td>' +
		'<td align="left">' + data[i].pIcmsInterestadual + '</td>' +
		'<td align="left">' + data[i].pMVAST + '</td>' +
		'<td align="left">' + data[i].pRedBCST + '</td>' +
		'<td align="left">' + data[i].pFCPST + '</td>' +
		'<td align="left">' + data[i].modBCST + '</td>' +
		'<td align="left">' + data[i].pDifal + '</td>' +
       	'<td align="center"><a href="javascript:;" onclick="excluirIvaTributacao('+ data[i].id +')"  class="btn btn-outline-vermelho btn-pequeno fas fa-trash" title="Excluir"></a></td></tr>'
	}
	$("#lista_iva_tributacao").html(html);
}

function excluirIvaTributacao(id){
    $.ajax({
      url: base_url + "tributacaoiva/"  + id ,
      type: "DELETE",
      data: {  },
      dataType:"Json",
      success: function(data){
          lista_iva_tributacao(data);
      }

  });
}

function limpar_iva_tributacao(){
	$("#cstIcms").val("");
	$("#uf_destino").val("TD");
	$("#modBCST").val("4");
	$("#cstIcms").val(" ");
	$("#pMVAST").val(" ");
	$("#pRedBCST").val(" ");
	$("#pIcmsInterestadual").val(" ");
	$("#pIcmsIntra").val(" ");
	$("#pDifal").val(" ");
	$("#pFCPSTRet").val(" ");
	$("#pFCPST").val(" ");
	$("#preco_unit_Pauta_ST").val(" ");
}

function tornarPadrao(id){
	if(confirm("Tem certeza que deseja tornar esta tributação como padrão")){
		$.ajax({
			url: base_url + "tributacao/tornarPadrao/" + id,
		   type: "GET",
		   dataType: "json",
		   data:{},
			 success: function(data){
				if(data.tem_erro == true){
					fecharGiraGira(0);
					$("#erroModalLivre").html(data.erro);
					abrirModalLivre("#modalLivreErro");
				}else{
					location.reload();
				}
			},
			  	beforeSend: function () {
				giraGira();
		     }

		});
	}
}

function abrirTelaProduto(id, natureza_id){
	$("#tributacao_id").val(id);
	$("#natureza_operacao_id").val(natureza_id);
	$.ajax({
	   url: base_url + "tributacao/listaProdutoTributacao/"  + id,
	   type: "GET",
	   dataType: "json",
	   data:{},
		 success: function(data){
			 lista_produto_tributacao(data);
		 }
	});
	abrirModal('#telaProduto');
}

$("#btnInserirProdutoTributacao").on("click", function(){
    var natureza_operacao_id= $("#natureza_operacao_id").val();
    var tributacao_id 		= $("#tributacao_id").val();
    var produto_id 			= $("#produto_id").val();

    if(natureza_operacao_id==""){
        alert("Selecionar a natureza de operação primeiramente");
        return;
    }

    if(tributacao_id==""){
        alert("Selecionar a tributação primeiramente");
        return;
    }

    if(produto_id==""){
        alert("Selecionar o Produto primeiramente");
        return;
    }

    $.ajax({
        url: base_url + "tributacaoproduto",
       type: "POST",
       dataType: "json",
       data:{
               produto_id				: produto_id,
               natureza_operacao_id	    : natureza_operacao_id,
               tributacao_id			: tributacao_id
           },
         success: function(data){
             lista_produto_tributacao(data);
             limpar_produto_tributacao();
         }

    });
});

function lista_produto_tributacao(data){
	html = "<tr>";
	for(var i in data){
		html += '<td align="center">' + data[i].id + '</td>' +
        '<td align="left">' + data[i].nome + '</td>' +
       	'<td align="center"><a href="javascript:;" onclick="excluirProdutoTributacao('+ data[i].id +')"  class="btn btn-outline-vermelho btn-pequeno fas fa-trash" title="Excluir"></a></td></tr>'
	}
	$("#lista_produto_tributacao").html(html);
}

function selecionarProdutoTributacao(obj){
	var id		= $(obj).attr('data-id');
	var nome	= $(obj).attr('data-nome');
	$(".listaProdutos").hide();

	$("#produto_id").val(id);
	$("#nomeProduto").val(nome);
	$("#nomeProduto").focus();

}

function excluirProdutoTributacao(id){
    $.ajax({
      url: base_url + "tributacaoproduto/"  + id ,
      type: "DELETE",
      data: {  },
      dataType:"Json",
      success: function(data){
          lista_produto_tributacao(data.retorno);
          limpar_produto_tributacao();
      }

  });
}


function limpar_produto_tributacao(){
	$("#produto_id").val("");
	$("#nomeProduto").val("");
}
