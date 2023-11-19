<div class="menu-lateral">
    <a href="<?php echo e(route('home')); ?>" class="logo d-block" style="background:none">
        <img src="<?php echo e(asset('assets/img/logo-brasil.png')); ?>">
    </a>
    <div class="logo-text">GESTORWEB</div>
    <nav class="menuprincipal" id="principal">
        <ul class="menu-ul icones">
            <li><a href="<?php echo e(route('home')); ?>">
                    <svg class="icon" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.25 11L10.204 2.04499C10.644 1.60599 11.356 1.60599 11.795 2.04499L20.75 11M3.5 8.74999V18.875C3.5 19.496 4.004 20 4.625 20H8.75V15.125C8.75 14.504 9.254 14 9.875 14H12.125C12.746 14 13.25 14.504 13.25 15.125V20H17.375C17.996 20 18.5 19.496 18.5 18.875V8.74999M7.25 20H15.5"
                            stroke="#341008" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Home</span>
                </a>
            </li>
            <li class="submenu">
                <a href="#">
                    <svg class="icon" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.5 14.875H14.875M14.875 14.875H18.25M14.875 14.875V11.5M14.875 14.875V18.25M4 8.5H6.25C6.84674 8.5 7.41903 8.26295 7.84099 7.84099C8.26295 7.41903 8.5 6.84674 8.5 6.25V4C8.5 3.40326 8.26295 2.83097 7.84099 2.40901C7.41903 1.98705 6.84674 1.75 6.25 1.75H4C3.40326 1.75 2.83097 1.98705 2.40901 2.40901C1.98705 2.83097 1.75 3.40326 1.75 4V6.25C1.75 6.84674 1.98705 7.41903 2.40901 7.84099C2.83097 8.26295 3.40326 8.5 4 8.5ZM4 18.25H6.25C6.84674 18.25 7.41903 18.0129 7.84099 17.591C8.26295 17.169 8.5 16.5967 8.5 16V13.75C8.5 13.1533 8.26295 12.581 7.84099 12.159C7.41903 11.7371 6.84674 11.5 6.25 11.5H4C3.40326 11.5 2.83097 11.7371 2.40901 12.159C1.98705 12.581 1.75 13.1533 1.75 13.75V16C1.75 16.5967 1.98705 17.169 2.40901 17.591C2.83097 18.0129 3.40326 18.25 4 18.25ZM13.75 8.5H16C16.5967 8.5 17.169 8.26295 17.591 7.84099C18.0129 7.41903 18.25 6.84674 18.25 6.25V4C18.25 3.40326 18.0129 2.83097 17.591 2.40901C17.169 1.98705 16.5967 1.75 16 1.75H13.75C13.1533 1.75 12.581 1.98705 12.159 2.40901C11.7371 2.83097 11.5 3.40326 11.5 4V6.25C11.5 6.84674 11.7371 7.41903 12.159 7.84099C12.581 8.26295 13.1533 8.5 13.75 8.5Z"
                            stroke="#341008" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>ADMINISTRATIVO</span>
                </a>
                <ul>
                    <li class="subcat">
                        <a href="">Usuários</a>                        
                    </li>
                    <li class="subcat">
                        <a href="">Filiais</a>
                    </li>                                
                    <li class="subcat">
                        <a href="">Resarcimento</a>                       
                    </li>
                    <li class="subcat">
                        <a href="">Sinistros</a>
                    </li>
                </ul>
            </li>
            <?php if(view()->exists('inc.menu.menuImagem')): ?>
                <?php echo $__env->make('inc.menu.menuImagem', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(view()->exists('inc.menu.menuComposicao')): ?>
                <?php echo $__env->make('inc.menu.menuComposicao', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(view()->exists('inc.menu.menuGrade')): ?>
                <?php echo $__env->make('inc.menu.menuGrade', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(view()->exists('inc.menu.menuEstoque')): ?>
                <?php echo $__env->make('inc.menu.menuEstoque', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(view()->exists('inc.menu.menuNfe')): ?>
                <?php echo $__env->make('inc.menu.menuNfe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(view()->exists('inc.menu.menuImportacao')): ?>
                <?php echo $__env->make('inc.menu.menuImportacao', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(view()->exists('inc.menu.menuManifesto')): ?>
                <?php echo $__env->make('inc.menu.menuManifesto', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(view()->exists('inc.menu.menuFrenteLoja')): ?>
                <?php echo $__env->make('inc.menu.menuFrenteLoja', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(view()->exists('inc.menu.menuVenda')): ?>
                <?php echo $__env->make('inc.menu.menuVenda', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(view()->exists('inc.menu.menuCompra')): ?>
                <?php echo $__env->make('inc.menu.menuCompra', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(view()->exists('inc.menuCaixa.menuCaixa')): ?>
                <?php echo $__env->make('inc.menuCaixa.menuCaixa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(view()->exists('inc.menu.menuFinanceiro')): ?>
                <?php echo $__env->make('inc.menu.menuFinanceiro', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(view()->exists('inc.menu.menuMercadoPago')): ?>
                <?php echo $__env->make('inc.menu.menuMercadoPago', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(view()->exists('inc.menu.menuEtiqueta')): ?>
                <?php echo $__env->make('inc.menu.menuEtiqueta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(view()->exists('inc.menu.menuUsuario')): ?>
                <?php echo $__env->make('inc.menu.menuUsuario', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </ul>
    </nav>

</div>
<?php /**PATH /var/www/resources/views/menu.blade.php ENDPATH**/ ?>