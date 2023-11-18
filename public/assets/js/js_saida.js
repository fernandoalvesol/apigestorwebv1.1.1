
$(function(){
    $("#produtosaida").on("keyup", function(){
        var q = $(this).val();
        if(q==""){
            $(".listaProdutos").hide();
            return false;
        }
        $.ajax({
            url:base_url+"produto/pesquisa",
            type:"GET",
            dataType:"JSON",
            data:{q:q},
            success:function(data){
                console.log(data);
                $("#produtosaida").after('<div class="listaProdutos"></div>');
                html="";
                for(var i in data){
                    html +='<div class="si"><a href="javascript:;" onclick="selecionarProdutoSaida(this)" ' +
                                  'data-id="'+data[i].id +
                                  '" data-preco = "' + data[i].preco_venda +
                                  '" data-nome  = "' + data[i].nome +
                                  '" data-estoque  	= "' + data[i].estoque_atual + '">' +
                                  data[i].id + " - " + data[i].nome + " - RS " + data[i].preco_venda + '</a></div>';
                }

                $(".listaProdutos").html(html);
                $(".listaProdutos").show();
            },
            error:function(data){

            }

        });
    });
})

function selecionarProdutoSaida(obj){
	var id					= $(obj).attr('data-id');
	var nome				= $(obj).attr('data-nome');
	var preco				= $(obj).attr('data-preco');
	var estoque				= $(obj).attr('data-estoque');

	$(".listaProdutos").hide();

	$("#produto_id").val(id);
	$("#produtosaida").val(nome);
	$("#preco").val(preco);
	$("#subtotal").val(preco);
	$("#qtde").val(1);
	$("#qtde").focus();

}

function inserirSaidaEstoque(){
    var produto_id	= $("#produto_id").val();
	var qtde		= $("#qtde").val();
	var valor		= $("#preco").val();

    if(produto_id==""){
        alert("Selecione um produto primeiramente");
        $("#produtosaida").focus();
        return false;
    }

    if(qtde==""){
        alert("Digite a quantidade");
        $("#qtde").focus();
        return false;
    }

    $.ajax({
        url:base_url+"saida/salvarJs",
        type:"POST",
        dataType:"JSON",
        data:{
            produto_id:produto_id,
            qtde :qtde,
            valor :valor
        },
        success:function(data){
            fecharModal();
            if(data.tem_erro==true){
                $("#mostrarUmErro").html(MostrarUmaMsgErro("Erro: " +  data.erro));
            }else{
                $("#mostrarSucesso").html(MostrarUmaMsgSucesso("inserido com sucesso"));
                location.reload();

            }
        },
        error:function(data){

        }

    });
}
