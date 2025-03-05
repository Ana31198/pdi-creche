

<?php $__env->startSection('content'); ?>
    <h1>Detalhes da Rotina</h1>

    <p><strong>Criança:</strong> <?php echo e($rotina->crianca->nome); ?></p>
    <p><strong>Data:</strong> <?php echo e($rotina->data); ?></p>
    <p><strong>Atividade:</strong> <?php echo e($rotina->atividade); ?></p>
    <p><strong>Descrição:</strong> <?php echo e($rotina->descricao); ?></p>

    <a href="<?php echo e(route('rotinas.index')); ?>">Voltar</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\dashboard\creche\resources\views/rotinas/show.blade.php ENDPATH**/ ?>