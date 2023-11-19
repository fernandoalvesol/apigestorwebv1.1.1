<?php if(Session::has('msg_sucesso')): ?>  
    <span class="msg msg-verde position-fixed right top">
    	<i class="fas fa-check"></i> <b>Sucesso!</b> <?php echo e(Session::get('msg_sucesso')); ?><a href="javascript:;" onclick="fecharMsg()" class="sair">x</a>
    </span>
<?php endif; ?>

<?php if(Session::has('msg_erro')): ?>  
    <span class="msg msg-vermelho position-fixed right top">
    	<i class="fas fa-check"></i> <b>Erro!</b> <?php echo e(Session::get('msg_erro')); ?><a href="javascript:;" onclick="fecharMsg()" class="sair">x</a>
    </span>
<?php endif; ?>

<?php if(Session::has('msg_atencao')): ?>  
    <span class="msg msg-azul position-fixed right top">
    	<i class="fas fa-check"></i> <b>Atenção!</b> <?php echo e(Session::get('msg_erro')); ?><a href="javascript:;" onclick="fecharMsg()" class="sair">x</a>
    </span>
<?php endif; ?>

<?php if(Session::has('msg_aviso')): ?>  
    <span class="msg msg-amarelo position-fixed right top">
    	<i class="fas fa-check"></i> <b>Aviso!</b> <?php echo e(Session::get('msg_erro')); ?><a href="javascript:;" onclick="fecharMsg()" class="sair">x</a>
    </span>
<?php endif; ?>


<?php /**PATH /var/www/resources/views/inc/msg.blade.php ENDPATH**/ ?>