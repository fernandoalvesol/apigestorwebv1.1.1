function calcularPreco(){
    let preco_custo = converteMoedaFloat( $('#preco_custo').val()) ;
    let margem_lucro = converteMoedaFloat($('#margem_lucro').val());
    let preco_venda = preco_custo + (preco_custo*margem_lucro*0.01);

    $("#preco_venda").val(converteFloatMoeda(preco_venda.toFixed(2)));
}

function inserirProdutoComposicao(){
	$.ajax({
		url: base_url + "composicaoproduto",
	   type: "POST",
	   dataType: "json",
	   data:{
			produto_pai_id: $("#produto_pai_id").val(),
			produto_filho_id: $("#produto_filho_id").val(),
			qtde: $("#qtde").val(),
		},
		 success: function(data){
			fecharModal();
			if(data.tem_erro ==true){
				$("#erroModalLivre").html(data.erro);
				abrirModalLivre("#modalLivreErro");
			}else{
			   lista_produto_composicao(data.retorno);
			}

		 },
		  beforeSend: function () {
			giraGira();
	     },error: function (data) {
			fecharGiraGira(eh_modal);
			if(data.status== 422){
				var errors = $.parseJSON(data.responseText);
				$('#listaErroModal').html('');
	        	$.each(errors.errors, function (key, erro) {
					 $('#listaErroModal').append('<li>' + erro + '</li>');
					 abrirModalLivre("#modalLivreListaComErros");
	        	});
			}else{

			}
		}
	});
}

function lista_produto_composicao(data){
	html = "<tr>";
	for(var i in data){
		html += '<td align="center">' + data[i].id + '</td>' +
        '<td align="left">' + data[i].produto_filho.nome + '</td>' +
		'<td align="left">' + data[i].qtde + '</td>' +
       	'<td align="center"><a href="javascript:;" onclick="excluirProdutoComposicao('+ data[i].id +')"  class="btn btn-outline-vermelho btn-pequeno fas fa-trash" title="Excluir"></a></td></tr>'
	}
	$("#lista_produto_composicao").html(html);
}

function excluirProdutoComposicao(id){
       $.ajax({
         url: base_url + "composicaoproduto/"  + id ,
         type: "DELETE",
         data: {  },
         dataType:"Json",
         success: function(data){
             lista_produto_composicao(data.retorno);
         }

     });
}


function upload_produto(){
	var data 	 	        = new FormData();
	var arquivos 	        = $('#img_produto2')[0].files;
	var produto_id 	        = $('#produto_id').val();


	if(arquivos.length > 0) {

		data.append('file', arquivos[0]);
		data.append('produto_id', produto_id);

		$.ajax({
			type:'POST',
			url:base_url + 'imagemproduto',
			data:data,
			contentType:false,
			processData:false,
			dataType: "json",
			beforeSend: function(){
				$('#uploadStatus').html('<img src=' + base_url + '"assets/img/loading.gif"/>');
			},
            error:function(){
                alert("erro");
            },
			success:function(data){
				lista_imagem(data);
			}
		});
	}
}

function excluirImagem(id){
    $.ajax({
      url: base_url + "imagemproduto/"  + id ,
      type: "DELETE",
      data: {  },
      dataType:"Json",
      success: function(data){
          lista_imagem(data.retorno);
      }

  });
}

function lista_imagem(data){
 html="";
 for(var i in data){
 var path = base_url + 'storage/'+ data[i].img;
 html +='<div class="col-2 d-flex mb-3">'+
     '<div class="banner-thumb radius-4 p-2 border" style="background:#fff">'+
         '<img src="' + path + '" class="img-fluido">'+
         '<a href="javascript:;" onclick="excluirImagem(' + data[i].id + ')" class="btn btn-vermelho btn-circulo"><i class="fas fa-times"></i></a>' +
     '</div>'+
 '</div>';
 }

$("#lista_imagens").html(html);
}
