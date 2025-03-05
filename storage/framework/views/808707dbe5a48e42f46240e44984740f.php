

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Lista de Rotinas</h1>
        <a href="<?php echo e(route('rotinas.create')); ?>" class="btn btn-success">Adicionar Nova Rotina</a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">
            <?php if($rotinas->isEmpty()): ?>
                <p class="text-muted text-center">Ainda não há rotinas registadas.</p>
            <?php else: ?>
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Criança</th>
                            <th>Atividade</th>
                            <th>Data</th>
                     
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $rotinas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rotina): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($rotina->crianca->nome); ?></td>
                                <td><?php echo e($rotina->atividade); ?></td>
                                <td><?php echo e(date('d/m/Y', strtotime($rotina->data))); ?></td>
                         
                                
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\dashboard\creche\resources\views/rotinas/index.blade.php ENDPATH**/ ?>