<?php $__env->startSection('conteudo'); ?>
    <div class="rows">
        <div class="col-12">
            <span class=" bg-title text-light text-uppercase h5 mb-0 text-branco">
                <svg class="icon cadastro" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.5 14.875H14.875M14.875 14.875H18.25M14.875 14.875V11.5M14.875 14.875V18.25M4 8.5H6.25C6.84674 8.5 7.41903 8.26295 7.84099 7.84099C8.26295 7.41903 8.5 6.84674 8.5 6.25V4C8.5 3.40326 8.26295 2.83097 7.84099 2.40901C7.41903 1.98705 6.84674 1.75 6.25 1.75H4C3.40326 1.75 2.83097 1.98705 2.40901 2.40901C1.98705 2.83097 1.75 3.40326 1.75 4V6.25C1.75 6.84674 1.98705 7.41903 2.40901 7.84099C2.83097 8.26295 3.40326 8.5 4 8.5ZM4 18.25H6.25C6.84674 18.25 7.41903 18.0129 7.84099 17.591C8.26295 17.169 8.5 16.5967 8.5 16V13.75C8.5 13.1533 8.26295 12.581 7.84099 12.159C7.41903 11.7371 6.84674 11.5 6.25 11.5H4C3.40326 11.5 2.83097 11.7371 2.40901 12.159C1.98705 12.581 1.75 13.1533 1.75 13.75V16C1.75 16.5967 1.98705 17.169 2.40901 17.591C2.83097 18.0129 3.40326 18.25 4 18.25ZM13.75 8.5H16C16.5967 8.5 17.169 8.26295 17.591 7.84099C18.0129 7.41903 18.25 6.84674 18.25 6.25V4C18.25 3.40326 18.0129 2.83097 17.591 2.40901C17.169 1.98705 16.5967 1.75 16 1.75H13.75C13.1533 1.75 12.581 1.98705 12.159 2.40901C11.7371 2.83097 11.5 3.40326 11.5 4V6.25C11.5 6.84674 11.7371 7.41903 12.159 7.84099C12.581 8.26295 13.1533 8.5 13.75 8.5Z"
                        stroke="#341008" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6 titlefluxo">
                            <p>CONTROLE DE ENTRADAS</p>
                        </div>
                    </div>
                </div> 
            </span>
            <div class="caixaentradas">
                <form action="<?php echo e(route('entrada.store')); ?>" class="form" method="POST">
                    <div class="">                    
                        <?php echo csrf_field(); ?>
                        <div class="p-2 radius-4 border">
                            <div class="">
                                <div class="rows center-middle">     
                                    <div class="col-md-5">
                                        <label class="text-label">Descrição </label>
                                        <input type="text" name="descricao" required
                                            value="" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label class="text-label d-block text-branco">Escolha a Operação </label>
                                        <select name="operacao" id="operacao" value="operacao" class="form-control">
                                            <option value="selecione">Selecione</option>
                                            <option value="MENSALIDADE">Mensalidade</option>
                                            <option value="ADESAO">Taxa de Adesão</option>
                                            <option value="CO-PARTICIPACAO">Co-Participação</option>
                                            <option value="ACORDO">Pagamento de Acordo</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="text-label d-block text-branco">Escolha o Escritorio </label>
                                        <select name="escritorio" id="escritorio" value="escritorio" class="form-control">
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
                                        <select name="pagamento" id="pagamento" value="pagamento" class="form-control">
                                            <option value="selecione">Selecione</option>
                                            <option value="DINHEIRO">DINHEIRO</option>
                                            <option value="TRANSFERENCIA">TRANSFERÊNCIA</option>
                                            <option value="PIX">PIX</option>
                                            <option value="OUTROS">OUTROS</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="text-label d-block text-branco">Data Entrada </label>
                                        <input type="date" name="data" required
                                            value=""
                                            class="form-control">
                                    </div>
                                    <div class="col-2">
                                        <label class="text-label d-block text-branco">Informe o Valor </label>
                                        <input type="text" name="preco" value=""
                                            required class="form-control">
                                    </div>
                                    <div class="col-1 mt-0 pt-5">
                                        <input type="submit" value="Enviar" class="w-100 btn btn-roxo text-uppercase">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>               
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/Caixa/entradas.blade.php ENDPATH**/ ?>