
function imprimirDanfe(){
	giraGira();
	window.open(base_url + 'nfe/imprimirDanfePelaNfe/'+nfe_id, '_blank');
	location.reload();
}

function fecharModalDanfe(){
	location.reload();
}
function editarNfe(){
	giraGira();
	location.href = base_url + "notafiscal/edit/" + nfe_id;
}


function excluirNfe(){
	giraGira();
	location.href = base_url + "notafiscal/excluir/" + nfe_id;
}
function baixarXmlNfe(){
	$("#gira_gira_opcoes").show();
	window.location.href= base_url + "nfe/baixarXML/" + nfe_id;
	//$("#gira_gira_opcoes").hide();
}

function baixarPdfNfe(){
	$("#gira_gira_opcoes").show();
	window.location.href= base_url + "nfe/baixarPdf/" + nfe_id;
	//$("#gira_gira_opcoes").hide();
}

function consultarNfe(){
	$("#gira_gira_opcoes").show();
	window.open(base_url + 'nfe/consultarNfe/'+ nfe_id, '_blank');
	location.reload();
	$("#gira_gira_opcoes").hide();
}

function telaCorrecao(nfe_id){
    $("#nfe_id").val(nfe_id);
	$("#gira_gira_correcao").hide();
	$("#div_erro_correcao").hide();

	abrirModal("#telaCorrecao");
}

function transmitirNfe(nfe_id){
	$("#gira_gira_transferir").show();
	$("#div_erro_transferir").hide();
	$("#mensagem_erro_transferir").html(" ");
	abrirModal('#modal_transferirNfe');
	$.ajax({
	   url: base_url + "nfe/transmitirJs/" + nfe_id,
	   type: "GET",
	   dataType: "json",
	   data:{},
		 success: function(data){
		 	 $("#gira_gira_transferir").hide();
		 	 if(data.tem_erro==true){
		 	 	$("#div_erro_transferir").show();
		 	 	$("#mensagem_erro_transferir").html(data.erro);
		 	 }

		 	  if(data.tem_erro==false){
		 	 	abrirModal('#telaImprimirDanfe');
		 	 }
		}, error: function (e) {
			var response = e.responseText;
			console.log(response.erro);
		}
	});
}

function cartaCorrecao(){
	var txtCorrecao = $("#txtCorrecao").val();
	var nfe_id = $("#nfe_id").val();
	if(txtCorrecao=='--'){
		alert("Digite algum valor");
		return false;
	}
	if(txtCorrecao.length < 15){
		alert("O texto precisa ter pelo menos 15 caracteres");
		return false;
	}
	 $.ajax({
		  url: base_url + "nfe/cartaCorrecao" ,
		  type: "Post",
		  dataType: "json",
		  data:{
		  		nfe_id: nfe_id,
		  		xCorrecao: txtCorrecao
		  },
		  beforeSend: function () {
	        $("#gira_gira_correcao").show();
	     },
		  success: function (data){
		    $("#gira_gira_correcao").hide();
		 	 if(data.tem_erro==true){
		 	 	$("#div_erro_correcao").show();
		 	 	$("#mensagem_erro_correcao").html(data.erro);
		 	 }

		 	  if(data.tem_erro==false){
		 	 	abrirModal('#telaImprimirCce');
		 	 }
		  }
	});
}

function imprimirCce(){
    var nfe_id = $("#nfe_id").val();
	fecharModal();
	window.open(base_url + 'nfe/imprimirCce/'+ nfe_id, '_blank');
	location.reload();
}

function telaCancelamento(nfe_id){
    $("#nfe_id").val(nfe_id);
	$("#gira_gira_cancelamento").hide();
	$("#div_erro_cancelamento").hide();

	abrirModal("#telaCancelamento");
}

function baixarXmlNfe(chave){
	$("#gira_gira_opcoes").show();
	window.location.href= base_url + "nfe/baixarXML/" + chave;
}


function fazerCancelamento(){
    var nfe_id = $("#nfe_id").val();
	$("#div_erro_cancelamento").hide();
	$("#mensagem_erro_cancelamento").html(" ");

	var txtcancelamento = $("#txtCancelamento").val();
	if(txtcancelamento=='--'){
		alert("Digite algum valor");
		return false;
	}

	if(txtcancelamento.length < 15){
		alert("O texto precisa ter pelo menos 15 caracteres");
		return false;
	}

	 $.ajax({
		  url: base_url + "nfe/cancelarNfe" ,
		  type: "Post",
		  dataType: "json",
		  data:{
                nfe_id: nfe_id,
		  		justificativa: txtcancelamento
		  },
		  beforeSend: function () {
	        $("#gira_gira_cancelamento").show();
	     },
		  success: function (data){
		    $("#gira_gira_cancelamento").hide();
		 	 if(data.tem_erro==true){
		 	 	$("#div_erro_cancelamento").show();
		 	 	$("#mensagem_erro_cancelamento").html(data.erro);
		 	 }

		 	  if(data.tem_erro==false){
                fecharModal();
		 	 	abrirModal('#telaImprimirCancelamento');
		 	 }
		  }
	});
}

function imprimirCancelamento(){
    var nfe_id = $("#nfe_id").val();
	fecharModal();
	window.open(base_url + 'nfe/imprimircancelado/'+nfe_id, '_blank');
	location.reload();
}

function telaEmail(){
	$("#gira_gira_enviar_email").hide();
	$("#div_erro_email").hide();
	abrirModal("#telaEmail");
}

function enviarEmail(){
	  var email = $("#email").val();
	  $("#div_erro_email").hide();
	  $("#gira_gira_enviar_email").show();
	 $.ajax({
		  url: base_url + "nfe/email",
		  type: "POST",
		  dataType: "json",
		  data:{
			id_nfe: nfe_id,
			email: email
		},
		  beforeSend: function () {
			$("#div_erro_email").hide();
	        $("#gira_gira_enviar_email").show();
	     },
		  success: function (data){
		  console.log(data);
			  if(data.tem_erro==true){
				  $("#gira_gira_enviar_email").hide();
				  $("#div_erro_email").show();
				  $("#mensagem_erro_email").html(data.erro);
			  }

			  if(data.tem_erro==false){
		 	 	alert("email enviado com sucesso");
		 	 	$("#gira_gira_enviar_email").hide();
		 	 }
		  },
	        error: function() {
				$("#div_erro_email").show();
	        }
	});
}


function verXml(){
	 $.ajax({
		  url: base_url + "nfe/verXML/" + nfe_id ,
		  type: "GET",
		  dataType: "json",
		  data:{},
		  success: function (data){
			  if(data.tem_erro){
				  alert(data.erro);
			  }
		  }
	});
}


