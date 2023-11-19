<div class="window medio" id="modalCategoria">
    <span class="d-block titulo mb-0 h4"><i class="fas fa-plus-circle"></i> Adicionar nova categoria</span>

    <div class="p-3">
        <div class="rows">
            <div class="col-12">
                <label class="text-label d-block">Nome </label>
                <input type="text" name="categoria" id="txtCategoria" class="form-campo"
                    placeholder="Inserir categoria">
            </div>
        </div>
    </div>
    <div class="tfooter end mt-4">
        <a href="javascript:;" onclick="fecharModal()" class="btn btn-outline-amarelo ">Cancelar</a>
        <input type="button" onclick="salvarCategoria()" value="Inserir categoria" class="btn btn-roxo text-uppercase">
    </div>
</div>
<?php /**PATH /var/www/resources/views/Cadastro/Categoria/modalCategoria.blade.php ENDPATH**/ ?>