<li class="submenu">
                <a href="#">
                    <svg class="icon" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.5 14.875H14.875M14.875 14.875H18.25M14.875 14.875V11.5M14.875 14.875V18.25M4 8.5H6.25C6.84674 8.5 7.41903 8.26295 7.84099 7.84099C8.26295 7.41903 8.5 6.84674 8.5 6.25V4C8.5 3.40326 8.26295 2.83097 7.84099 2.40901C7.41903 1.98705 6.84674 1.75 6.25 1.75H4C3.40326 1.75 2.83097 1.98705 2.40901 2.40901C1.98705 2.83097 1.75 3.40326 1.75 4V6.25C1.75 6.84674 1.98705 7.41903 2.40901 7.84099C2.83097 8.26295 3.40326 8.5 4 8.5ZM4 18.25H6.25C6.84674 18.25 7.41903 18.0129 7.84099 17.591C8.26295 17.169 8.5 16.5967 8.5 16V13.75C8.5 13.1533 8.26295 12.581 7.84099 12.159C7.41903 11.7371 6.84674 11.5 6.25 11.5H4C3.40326 11.5 2.83097 11.7371 2.40901 12.159C1.98705 12.581 1.75 13.1533 1.75 13.75V16C1.75 16.5967 1.98705 17.169 2.40901 17.591C2.83097 18.0129 3.40326 18.25 4 18.25ZM13.75 8.5H16C16.5967 8.5 17.169 8.26295 17.591 7.84099C18.0129 7.41903 18.25 6.84674 18.25 6.25V4C18.25 3.40326 18.0129 2.83097 17.591 2.40901C17.169 1.98705 16.5967 1.75 16 1.75H13.75C13.1533 1.75 12.581 1.98705 12.159 2.40901C11.7371 2.83097 11.5 3.40326 11.5 4V6.25C11.5 6.84674 11.7371 7.41903 12.159 7.84099C12.581 8.26295 13.1533 8.5 13.75 8.5Z"
                            stroke="#341008" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Financeiro</span>
                </a>
                <ul>
                    <li class="subcat">
                        <a href="">Plano de Conta</a>
                        <ul>
                            <li><a href="<?php echo e(route('planoconta.index')); ?>">Plano de Conta</a></li>
                        </ul>
                    </li>

                    <li class="subcat">
                        <a href="">Centro de Custo</a>
                        <ul>
                            <li><a href="<?php echo e(route('centrocusto.index')); ?>">Centro de Custo</a></li>
                        </ul>
                    </li>

                    <li class="subcat">
                        <a href="">Despesas Fixas</a>
                        <ul>
                            <li><a href="<?php echo e(route('despesafixa.index')); ?>">Despesas Fixas</a></li>
                        </ul>
                    </li>


                    <li class="subcat">
                        <a href="">Contas a Receber</a>
                        <ul>
                            <li><a href="<?php echo e(route('contareceber.index')); ?>">Contas a Receber</a></li>
                            <li><a href="<?php echo e(route('recebimento.index')); ?>">Recebimento</a></li>
                        </ul>
                    </li>

                    <li class="subcat">
                        <a href="">Contas a Pagar</a>
                        <ul>
                            <li><a href="<?php echo e(route('contapagar.index')); ?>">Contas a Pagar</a></li>
                            <li><a href="<?php echo e(route('pagamento.index')); ?>">Pagamentos</a></li>
                        </ul>
                    </li>

                </ul>
            </li><?php /**PATH /var/www/appgestorweb/resources/views/inc/menu/menuFinanceiro.blade.php ENDPATH**/ ?>