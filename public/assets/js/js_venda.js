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
                    html +='<div class="si"><a href="javascript:;" onclick="selecionarProdutoVenda(this)" ' +
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

   $("#desc_cliente").on("keyup", function(){
	   var q = $(this).val();
	   if(q==""){
		   return;
	   }
	   $.ajax({
		   url: base_url + "cliente/pesquisa",
		   type: "GET",
		   dataType: "json",
		   data: {q:q},
		   success: function (data){
			   $("#desc_cliente").after('<ol class="listaClientes"></ol>');
			   html="";
			   for(var i in data){
				   html +=	'<li><a href="javascript:;" onclick="selecionarClienteVenda(this)" ' +
				   		  	'data-cliente_id="'+data[i].id +
							'" data-nome_razao_social = "' + data[i].nome_razao_social + '">' +
				   		 	 data[i].nome_razao_social + '</a></li>'
				}

			   $(".listaClientes").html(html);
			   $(".listaClientes").show();
		   }
	   });
   })

   $("#desc_vendedor").on("keyup", function(){
	   var q = $(this).val();
	   if(q==""){
		   return;
	   }
	   $.ajax({
		   url: base_url + "vendedor/pesquisa",
		   type: "GET",
		   dataType: "json",
		   data: {q:q},
		   success: function (data){
			   $("#desc_vendedor").after('<ol class="listaVendedores"></ol>');
			   html="";
			   for(var i in data){
				   html +=	'<li><a href="javascript:;" onclick="selecionarVendedorVenda(this)" ' +
				   		  	'data-vendedor_id="'+data[i].id +
							'" data-nome = "' + data[i].nome + '">' +
				   		 	 data[i].nome + '</a></li>'
				}

			   $(".listaVendedores").html(html);
			   $(".listaVendedores").show();
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



//Desconto da Venda
$('#valor_frete').on('keyup', () => {
	atualizaTotalCompra()
})

$('#desconto_venda_por_valor').on('keyup', () => {
	$('#desconto_venda_por_percentual').val(0);
	atualizaTotalCompra()
})

$('#desconto_venda_por_percentual').on('keyup', () => {
	$('#desconto_venda_por_valor').val(0);
	atualizaTotalCompra()
})

$('#total_seguro').on('keyup', () => {
	atualizaTotalCompra()
})

$('#despesas_outras').on('keyup', () => {
	atualizaTotalCompra()
})

function atualizaTotalCompra() {
	var valor_frete		= ($('#valor_frete').val() !="") ? converteMoedaFloat($('#valor_frete').val()) : parseFloat(0);
	//var total_seguro 	= ($('#total_seguro').val() !="") ? converteMoedaFloat($('#total_seguro').val()) : parseFloat(0);
	var despesas_outras = ($('#despesas_outras').val() !="") ? converteMoedaFloat($('#despesas_outras').val()) : parseFloat(0);
	var desconto_valor 	= ($('#desconto_venda_por_valor').val() !="") ? converteMoedaFloat($('#desconto_venda_por_valor').val()) : parseFloat(0);
	var desconto_per 	= ($('#desconto_venda_por_percentual').val() !="") ? converteMoedaFloat($('#desconto_venda_por_percentual').val()) : parseFloat(0);

	let total_da_venda  = converteMoedaFloat($('#valor_venda').val())  ;

	if(desconto_valor!="" && desconto_valor!="0"){
		total_da_venda = total_da_venda - desconto_valor ;
		desconto_per="";
	}

	if(desconto_per!=""  && desconto_per!="0"){
		total_da_venda = total_da_venda - (total_da_venda * desconto_per * 0.01) ;
		desconto_valor="";
	}
	TOTAL_VENDA = parseFloat(total_da_venda +  valor_frete +  despesas_outras).toFixed(2);
	$('#totalvenda').val(converteFloatMoeda(TOTAL_VENDA));
	$("#valor_parcela").val(converteFloatMoeda(TOTAL_VENDA));
}

function selecionarClienteVenda(obj){
	var id					= $(obj).attr('data-cliente_id');
	var nome				= $(obj).attr('data-nome_razao_social');

	$(".listaClientes").hide();
	$("#cliente_id").val(id);
	$("#desc_cliente").val(nome);
}

function selecionarVendedorVenda(obj){
	var id					= $(obj).attr('data-vendedor_id');
	var nome				= $(obj).attr('data-nome');

	$(".listaVendedores").hide();
	$("#vendedor_id").val(id);
	$("#desc_vendedor").val(nome);
}
function selecionarProdutoVenda(obj){
	var id					= $(obj).attr('data-id');
	var nome				= $(obj).attr('data-nome');
	var preco				= $(obj).attr('data-preco');
	var estoque				= $(obj).attr('data-estoque');

	$(".listaProdutos").hide();

	$("#produto_id").val(id);
	$("#desc_produto").val(nome);
	$("#preco").val(converteFloatMoeda(preco));
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

function inserirVenda(){
	var cliente_id		= $('#cliente_id').val();
	var	vendedor_id		= $('#vendedor_id').val();

	if( (cliente_id == '--') || (cliente_id == '') ||(cliente_id == 'null') ||(cliente_id == null)) {
		fecharModal();
		$("#mostrarUmErro").html(MostrarUmaMsgErro("Não foi possível salvar a venda, Selecione um cliente para continuar!"));
		return false;
	}

	$.ajax({
		url: base_url + "venda",
	   type: "POST",
	   dataType: "json",
	   data:{
	   		cliente_id 		: cliente_id,
	   		vendedor_id 	: vendedor_id,
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
    let    venda_id = $("#venda_id").val();
    let    produto_id= $("#produto_id").val();
    let    quantidade= $("#quantidade").val();
    let    valor= $("#preco").val();
    let    desconto_percentual= $('#desconto_percentual').val();
    let    desconto_por_valor= $('#desconto_por_valor').val();


	if( (cliente_id == '--') || (cliente_id == '') ||(cliente_id == 'null') ||(cliente_id == null)) {
		fecharModal();
		$("#mostrarUmErro").html(MostrarUmaMsgErro("Não foi possível salvar a venda, Selecione um cliente para continuar!"));
		return false;
	}

	$.ajax({
		url: base_url + "itemvenda",
	   type: "POST",
	   dataType: "json",
	   data:{
            venda_id 		: venda_id,
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

function finalizarVenda(id) {
	var cliente_id 		= $("#cliente_id").val();
	var vendedor_id 	= $("#vendedor_id").val();
	//var gerar_nota      = $("input[name='lancar_nota']:checked").val();
	//var natureza_operacao_id = $("#natureza_operacao_id").val();
	var natureza_operacao_id = 1;
    /*	if(gerar_nota=="S"){
		if(natureza_operacao_id==null || natureza_operacao_id==""  ){
			alert('Selecione Uma Natureza de Operação Primeiramente')
			return;
		}
	}*/

	$.ajax({
		type: 'POST',
		data: {
			"venda_id"      : $("#venda_id").val(),
			"cliente_id"	: cliente_id,
			"vendedor_id"   : vendedor_id,
			"natureza_operacao_id": natureza_operacao_id,
			"gerar_estoque" : "S",
			"gerar_financeiro": "S",
			"gerar_nota"    : "S"
		},
		url: base_url + 'venda/finalizarVenda' ,
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


function inserirDuplicata(){
	var tPag 				= $("#tPag").val();
	var forma_de_parcelar 	= $("#forma_de_parcelar").val()
	var qtde_parcela 		= $("#qtde_parcela").val();
	var valor 				= $("#vLiq").val();
	var venda_id 			= $("#venda_id").val();
    $.ajax({
         url: base_url + "duplicata/inserir",
         type: "post",
         dataType:"Json",
         data:{
        	 venda_id     		: venda_id ,
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
         url: base_url + "duplicata/salvarAlteracao",
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
       url: base_url + "duplicata/excluir/" + id ,
       type: "GET",
       data: {  },
       dataType:"Json",
       success: function(data){
			//location.reload();
			fecharGiraGira();
			location.reload();
			//window.location.href = base_url + "notafiscal/edit/" + venda_id +"#tab-7" ;

       },
         beforeSend: function(){
             giraGira();
        }

   });
}

function atualizarDadosPagamentos(id){
	$.ajax({
         url: base_url + "venda/atualizarDadosPagamentos",
         type: "post",
         dataType:"Json",
         data:{
        	 venda_id     		: id ,
        	 vendedor_id		: $('#vendedor_id').val(),
        	 valor_frete		: $("#valor_frete").val() ,
			 despesas_outras	: $("#despesas_outras").val(),
        	 desconto_valor		: $("#desconto_venda_por_valor").val() ,
        	 desconto_per		: $("#desconto_venda_por_percentual").val()
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
