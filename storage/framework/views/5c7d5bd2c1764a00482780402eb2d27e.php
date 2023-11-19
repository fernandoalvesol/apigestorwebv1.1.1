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
            <span class="text-branco"><?php echo e(Auth::user()->name ?? null); ?></span>
            <ul>
                <li><a href="#" class=""><i class="fas fa-lock"></i> Meu Perfil</a> </li>

                <li><a href="<?php echo e(route('logout')); ?>">Sair</a></li>
            </ul>
        </li>
    </ul>
</div>
<?php /**PATH /var/www/resources/views/cabecalho.blade.php ENDPATH**/ ?>