<div class="">                           
    <div class="p-2 radius-4 border">
    <div class="">
        <div class="rows center-middle">     
            <div class="col-md-5">
                <label class="text-label">Descrição </label>
                <input type="text" name="descricao" required class="form-control" value="{{ $caixas->descricao ?? old('descricao') }}">
            </div>
            <div class="col-3">
                <label class="text-label d-block text-branco">Escolha a Operação </label>
                <select name="operacao" id="operacao" class="form-control" value="{{ $caixas->operacao ?? old('operacao') }}">
                    <option value="selecione">Selecione</option>
                    <option value="REFEIÇÃO">Refeição</option>
                    <option value="ABASTECIMENTO">Abastecimento</option>
                    <option value="SANGRIA">Sangria</option>
                    <option value="DIVERSOS">Diversos</option>
                </select>
            </div>
            <div class="col-3">
                <label class="text-label d-block text-branco">Escolha o Escritorio </label>
                <select name="escritorio" id="escritorio" class="form-control" value="{{ $caixas->escritorio ?? old('escritorio') }}">
                    <option value="selecione">Selecione</option>
                    <option value="ITAQUITINGA">Setta Itaquitinga</option>
                    <option value="CONDADO">Setta Condado</option>
                    <option value="GOIANA">Setta Goiana</option>
                    <option value="PEDRAS DE FOGO">Setta Pedras de Fogo</option>
                    <option value="ARACOIABA">Setta Araçoiaba</option>
                    <option value="CARPINA">Setta Carpina</option>
                    <option value="TELECOM GOIANA">Telecom Goiana</option>
                    <option value="TELECOM CONDADO">Telecom Condado</option>
                    <option value="TELECOM ITAQUITINGA">Telecom Itaquitinga</option>
                    <option value="TELECOM ITAMBE">Telecom Itambe</option>
                </select>
            </div>
            <div class="col-3">
                <label class="text-label d-block text-branco">Forma de Pagamento </label>
                <select name="pagamento" id="pagamento" class="form-control" value="{{ $caixas->pagamento ?? old('pagamento') }}">
                    <option value="selecione">Selecione</option>
                    <option value="DINHEIRO">DINHEIRO</option>
                    <option value="TRANSFERENCIA">TRANSFERÊNCIA</option>
                    <option value="PIX">PIX</option>
                    <option value="OUTROS">OUTROS</option>
                </select>
            </div>
            <div class="col-3">
                <label class="text-label d-block text-branco">Data Entrada </label>
                <input type="date" name="data" required class="form-control" value="{{ $caixas->data ?? old('data') }}">
            </div>
            <div class="col-2">
                <label class="text-label d-block text-branco">Informe o Valor </label>
                <input type="text" name="preco" required class="form-control" value="{{ $caixas->preco ?? old('preco') }}">
            </div>
            <div class="col-1 mt-0 pt-5">
                <input type="submit" value="Enviar" class="w-100 btn btn-roxo text-uppercase">
            </div>
            </div>
        </div>
    </div>
</div>