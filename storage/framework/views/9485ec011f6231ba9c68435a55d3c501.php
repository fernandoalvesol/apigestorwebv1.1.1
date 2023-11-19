<?php if(isset($errors)): ?>

    <?php if(count($errors) == 1): ?>
        <span class="msg msg-vermelho position-fixed right top" id="msg_lista_um_erro">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <i class="fas fa-bug"></i> <b>Ops!</b> <?php echo e($erro); ?> <a href="javascript:;" onclick="fecharMsg()"
                    class="sair">x</a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </span>
        <script>
            $("#msg_lista_um_erro");
        </script>
    <?php elseif(count($errors) > 1): ?>
        <span class="msg msg-vermelho position-fixed right top" id="msg_lista_varios_erros">
            <i class="fas fa-bug"></i> <b>Ops!</b> Erros Encontrados
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($erro); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <a href="javascript:;" onclick="fecharMsg()" class="sair">x</a>
        </span>

    <?php endif; ?>
    <script>
        $("#msg_lista_um_erro");
    </script>
    <script>
        $("#msg_lista_varios_erros");
    </script>
<?php endif; ?>
<?php /**PATH /var/www/resources/views/inc/erros.blade.php ENDPATH**/ ?>