

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1>Lista de Rotinas</h1>

    <a href="<?php echo e(route('rotinas.create')); ?>" class="btn btn-primary mb-3">Adicionar Nova Rotina</a>

    <?php if($rotinas->isEmpty()): ?>
        <p>Não existem rotinas registadas.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Criança</th>
                    <th>Atividade</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $rotinas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rotina): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($rotina->crianca->nome ?? 'Sem Nome'); ?></td>
                        <td><?php echo e($rotina->atividade); ?></td>
                        <td><?php echo e($rotina->data); ?></td>
                        <td>
                            <a href="<?php echo e(route('rotinas.show', $rotina->id)); ?>" class="btn btn-info btn-sm">Ver</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\dashboard\creche\resources\views/criancas/rotinas.blade.php ENDPATH**/ ?>