$(function () {
	$("#desc_produto").on("keyup", function(){
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
             console.log(data);
                $("#desc_produto").after('<div class="listaProdutos"></div>');

                html="";
                for(var i in data){
                    html +='<div class="si"><a href="javascript:;" onclick="selecionarProdutoCompra(this)" ' +
                                  'data-id="'+data[i].id +
                                  '" data-preco = "' + data[i].preco_venda +
                                  '" data-nome  = "' + data[i].nome +
                                  '" data-estoque  	= "' + data[i].estoque_atual +
                             '" data-unidade = "' + data[i].unidade + '">' +
                              data[i].nome + " - RS " + data[i].preco_venda + '</a></div>';
                }

                $(".listaProdutos").html(html);
                $(".listaProdutos").show();
            }
        });
    })

   $("#desc_fornecedor").on("keyup", function(){
	   var q = $(this).val();
	   if(q==""){
		   return;
	   }
	   $.ajax({
		   url: base_url + "fornecedor/pesquisa",
		   type: "GET",
		   dataType: "json",
		   data: {q:q},
		   success: function (data){
			   $("#desc_fornecedor").after('<ol class="listaFornecedores"></ol>');
			   html="";
			   for(var i in data){
				   html +=	'<li><a href="javascript:;" onclick="selecionarFornecedorCompra(this)" ' +
				   		  	'data-fornecedor_id="'+data[i].id +
							'" data-nome_razao_social = "' + data[i].razao_social + '">' +
				   		 	 data[i].razao_social + '</a></li>'
				}

			   $(".listaFornecedores").html(html);
			   $(".listaFornecedores").show();
		   }
	   });
   })


});

$('#quantidade').on('keyup', () => {
	calcularDescontoItem();
})

$('#val_desconto').on('keyup', () => {
		calcularDescontoItem();
})

$('#val_desconto').on('blur', () => {
	let val_desconto= $('#val_desconto').val();
	if(val_desconto==null || val_desconto==''  ){
		$('#val_desconto').val(0);
	}
	calcularDescontoItem();
})


$('#desconto_percentual').on('keyup', () => {
	$('#desconto_por_valor').val(0);
	calcularDescontoItem();
})

$('#desconto_por_valor').on('keyup', () => {
	$('#desconto_percentual').val(0);
	calcularDescontoItem()
})
function selecionarFornecedorCompra(obj){
	var id					= $(obj).attr('data-fornecedor_id');
	var nome				= $(obj).attr('data-nome_razao_social');

	$(".listaFornecedores").hide();
	$("#fornecedor_id").val(id);
	$("#desc_fornecedor").val(nome);
}

function selecionarVendedorCompra(obj){
	var id					= $(obj).attr('data-vendedor_id');
	var nome				= $(obj).attr('data-nome');

	$(".listaVendedor").hide();
	$("#vendedor_id").val(id);
	$("#desc_vendedor").val(nome);
}
function selecionarProdutoCompra(obj){
	var id					= $(obj).attr('data-id');
	var nome				= $(obj).attr('data-nome');
	var preco				= $(obj).attr('data-preco');
	var estoque				= $(obj).attr('data-estoque');

	$(".listaProdutos").hide();

	$("#produto_id").val(id);
	$("#desc_produto").val(nome);
	$("#preco").val(preco);
	$("#usa_grade").val(usa_grade);
	$("#estoque").val(estoque);
	$("#estoque_grade").val(estoque_grade);
	$("#subtotal").val(preco);
	$("#quantidade").val(1);
	$("#total_item").val(converteFloatMoeda(preco));
	calcularDescontoItem();
	$("#preco").focus();
}
function calcularDescontoItem(){
	let qtde 				= converteMoedaFloat($('#quantidade').val());
	let preco 				= converteMoedaFloat($('#preco').val());
	let subtotal 			= preco * qtde;
	let desconto_por_valor	= converteMoedaFloat($('#desconto_por_valor').val());
	var desconto_percentual = converteMoedaFloat($('#desconto_percentual').val());
	var desconto_por_unidade= parseFloat(0);
    var subtotal_liquido 	= subtotal;
    var total_desconto_item = 0;

	if(desconto_percentual > 0){
		desconto_por_unidade =  preco * desconto_percentual * 0.01 ;
	}

	if(desconto_por_valor > 0){
		desconto_por_unidade = desconto_por_valor;
	}

	subtotal_liquido = 	(preco-desconto_por_unidade) * qtde ;
	total_desconto_item = desconto_por_unidade * qtde;

	$('#subtotal_liquido').val(converteFloatMoeda((subtotal_liquido).toFixed(2)));
	$('#total_desconto_item').val(converteFloatMoeda(total_desconto_item.toFixed(2)));
	$('#subtotal').val(converteFloatMoeda(subtotal.toFixed(2)));
}

function inserirCompra(){
	var fornecedor_id		= $('#fornecedor_id').val();

	if( (fornecedor_id == '--') || (fornecedor_id == '') ||(fornecedor_id == 'null') ||(fornecedor_id == null)) {
		fecharModal();
		$("#mostrarUmErro").html(MostrarUmaMsgErro("Não foi possível salvar a compra, Selecione um fornecedor para continuar!"));
		return false;
	}

	$.ajax({
		url: base_url + "compra",
	   type: "POST",
	   dataType: "json",
	   data:{
	   		fornecedor_id 		: fornecedor_id,
	   	},
		 beforeSend: function (){
		   giraGira();
	   },
		success: function (data) {
			fecharModal();
			if(data.tem_erro ==true){
				$("#mostrarUmErro").html(MostrarUmaMsgErro(" Erro: " + data.erro));
			}else{
				location.href = data.redirect;
			}
		}, error: function (e) {
			console.log(e);
			fecharModal();
			var response = JSON.parse(e.responseText);
			$("#mostrarErros").html(MostrarMsgErros(response.errors));
		}

	});
}


function inserirItem(){
    let    compra_id = $("#compra_id").val();
    let    produto_id= $("#produto_id").val();
    let    quantidade= $("#quantidade").val();
    let    valor= $("#preco").val();
    let    desconto_percentual= $('#desconto_percentual').val();
    let    desconto_por_valor= $('#desconto_por_valor').val();


	if( (fornecedor_id == '--') || (fornecedor_id == '') ||(fornecedor_id == 'null') ||(fornecedor_id == null)) {
		fecharModal();
		$("#mostrarUmErro").html(MostrarUmaMsgErro("Não foi possível salvar a compra, Selecione um fornecedor para continuar!"));
		return false;
	}

	$.ajax({
		url: base_url + "itemcompra",
	   type: "POST",
	   dataType: "json",
	   data:{
            compra_id 		: compra_id,
            produto_id 	: produto_id,
            quantidade : quantidade,
            valor			: valor,
            desconto_percentual			: desconto_percentual,
            desconto_por_valor			: desconto_por_valor
	   	},
		 beforeSend: function (){
		   giraGira();
	   },
		success: function (data) {
			fecharModal();
			if(data.tem_erro ==true){
				$("#mostrarUmErro").html(MostrarUmaMsgErro(" Erro: " + data.erro));
			}else{
				location.href = data.redirect;
			}
		}, error: function (e) {
			console.log(e);
			fecharModal();
			var response = JSON.parse(e.responseText);
			$("#mostrarErros").html(MostrarMsgErros(response.errors));
		}

	});
}

function inserirDuplicata(){
	var tPag 				= $("#tPag").val();
	var forma_de_parcelar 	= $("#forma_de_parcelar").val()
	var qtde_parcela 		= $("#qtde_parcela").val();
	var valor 				= $("#vLiq").val();
	var compra_id 			= $("#compra_id").val();
    $.ajax({
         url: base_url + "duplicatacompra/inserir",
         type: "post",
         dataType:"Json",
         data:{
        	 compra_id     		: compra_id ,
        	 tPag				: tPag ,
        	 forma_de_parcelar	: forma_de_parcelar,
			 qtde_parcela		: qtde_parcela,
			 valor				: valor,
         },
         success: function(data){
			location.reload();
         },
         beforeSend: function(){

        }

     });

 }

 function alterarDuplicata(id){
	var tPag 				= $("#tPag_"+id).val();
	var dVenc 				= $("#vencimento_"+id).val()
	var obs 				= $("#obs_"+id).val();

    $.ajax({
         url: base_url + "duplicatacompra/salvarAlteracao",
         type: "post",
         dataType:"Json",
         data:{
        	 id     		: id ,
        	 tPag			: tPag ,
        	 dVenc			: dVenc,
			 obs			: obs,
         },
         success: function(data){
			  console.log(data);
        	  fecharGiraGira();
         },
         beforeSend: function(){
             giraGira();
        }

     });

 }

 function lista_duplicata(data){
	    var html = "";
	    for(var i in data){
	        html += "<tr> " +
	               "<td align='center' >" + data[i].nDup + "</td>" +
	               "<td align='center' >" + data[i].dVenc + "</td>" +
	               "<td align='center' >" + data[i].vDup + "</td>" +
				   "<td align='center' >" + data[i].pagamento + "</td>" +
	               "<td align='center' ><a href='javascript:;' onclick='excluirDuplicata("+ data[i].id +")'  class='btn btn-sm btn-danger d-inline-block' title='Excluir'><i class='fas fa-trash'></i></a></td>" +
	       "</tr>";
	    }
	    $("#lista_duplicata").html(html);

	}

 function excluirDuplicata(id){
     $.ajax({
       url: base_url + "duplicatacompra/excluir/" + id ,
       type: "GET",
       data: {  },
       dataType:"Json",
       success: function(data){
			//location.reload();
			fecharGiraGira();
			location.reload();
			//window.location.href = base_url + "notafiscal/edit/" + compra_id +"#tab-7" ;

       },
         beforeSend: function(){
             giraGira();
        }

   });
}


function finalizarCompra(id) {
	//var gerar_nota = $("input[name='lancar_nota']:checked").val();

	$.ajax
	({
		type: 'POST',
		data: {
			"compra_id" : id,

		},
		url: base_url + 'compra/finalizarCompra' ,
		dataType: 'json',
		beforeSend: function (){
		   giraGira();
	   },
		success: function (data) {
			fecharModal();
			if(data.tem_erro ==true){
				$("#mostrarUmErro").html(MostrarUmaMsgErro(" Erro: " + data.erro));
			}else{
				location.href = data.redirect ;
			}
		}, error: function (e) {
			console.log(e);
			fecharModal();
			var response = JSON.parse(e.responseText);
			$("#mostrarErros").html(MostrarMsgErros(response.errors));
		}
	});

}


function atualizarDadosPagamentos(id){
	$.ajax({
         url: base_url + "admin/compra/atualizarDadosPagamentos",
         type: "post",
         dataType:"Json",
         data:{
        	 compra_id     		: id ,
        	 fornecedor_id		: $('#fornecedor_id').val(),
        	 valor_frete		: $("#valor_frete").val() ,
        	 total_seguro		: $("#total_seguro").val(),
			 despesas_outras	: $("#despesas_outras").val(),
        	 desconto_valor		: $("#desconto_valor").val() ,
        	 desconto_per		: $("#desconto_per").val()
         },
         success: function(data){
        	fecharModal();
			if(data.tem_erro ==true){
				$("#mostrarUmErro").html(MostrarUmaMsgErro(" Erro: " + data.erro));
			}else{
				alert("atualizacao com sucesso");
				href.reload();
			}
         },
         beforeSend: function(){
             giraGira();
        }, error: function (e) {
			fecharModal();
			var response = JSON.parse(e.responseText);
			$("#mostrarErros").html(MostrarMsgErros(response.errors));
		}

     });
}
