<div class="topo d-flex text-end">
    <?php
        $imgPerfil = Auth::user()->foto ?? '';
    ?>

    <a href="" class="mobmenu alt"><i class="fas fa-bars"></i></a>
    <ul class="menu-topo">
        <li class="sub">
            <?php if($imgPerfil): ?>
                <img src="<?php echo e(url($imgPerfil)); ?>" class="img-user">
            <?php else: ?>
                <img src="<?php echo e(asset('assets/img/logo-brasil.png')); ?>" class="img-user">
            <?php endif; ?>
            <span class="text-branco"><a href="<?php echo e(route('logout')); ?>">SAIR</a>
            </span>
            
        </li>
    </ul>
</div>
<?php /**PATH /var/www/resources/views/cabecalho.blade.php ENDPATH**/ ?>