function salvarCategoria(){
    var categoria = $("#txtCategoria").val();
    $.ajax({
        url:base_url+"categoria/salvarJs",
        type:"POST",
        dataType:"JSON",
        data:{categoria:categoria},
        success:function(data){
            fecharModal();
            if(data.tem_erro==true){
                $("#mostrarUmErro").html(MostrarUmaMsgErro("Erro: " +  data.erro));
            }else{
                $("#mostrarSucesso").html(MostrarUmaMsgSucesso("inserido com sucesso"));
                var html = "";
                for(i=0; i<data.lista.length; i++){
                    html +="<option value='"+ data.lista[i].id+"'>"+ data.lista[i].categoria+" </option>";
                }

                $("#cb_categoria_id").html(html);

            }
        },
        error:function(data){

        }

    });
}
