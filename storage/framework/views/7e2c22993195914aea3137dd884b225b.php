

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4">Lista de Presenças</h1>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary"> </h1>
        <a href="<?php echo e(route('presencas.create')); ?>" class="btn btn-success">Adicionar uma nova presenca</a>
    </div>
    <?php if($alertas->count() > 0): ?>
        <div class="alert alert-danger mb-4">
            <strong>Atenção!</strong> As seguintes crianças ainda estão na creche após o horário permitido:
            <ul>
                <?php $__currentLoopData = $alertas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alerta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($alerta->crianca->nome); ?> (Entrada: <?php echo e($alerta->hora); ?>)</li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Criança</th>
                    <th>Data</th>
                    <th>Hora de Entrada</th>
                    <th>Responsável</th>
                    <th>Hora de Saída</th>
                    <th>Retirado Por</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $presencas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $presenca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($presenca->crianca->nome); ?></td>
                        <td><?php echo e($presenca->data); ?></td>
                        <td><?php echo e($presenca->hora); ?></td>
                        <td><?php echo e($presenca->responsavel); ?></td>
                        <td>
                            <?php if($presenca->saida): ?>
                                <?php echo e($presenca->saida); ?>

                            <?php else: ?>
                                <span class="text-danger">Ainda na creche</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($presenca->retirado_por): ?>
                                <?php echo e($presenca->retirado_por); ?>

                            <?php else: ?>
                                ---
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if(!$presenca->saida): ?>
                                <form action="<?php echo e(route('presencas.registar_saida', $presenca->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <input type="text" name="retirado_por" class="form-control form-control-sm mb-2" placeholder="Nome do responsável" required>
                                    <button type="submit" class="btn btn-danger btn-sm">Retirar Criança</button>
                                </form>
                                <?php if(session('error')): ?>
                                    <div class="text-danger mt-2"><?php echo e(session('error')); ?></div>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="text-success">✔️ Retirada</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\dashboard\creche\resources\views/presencas/index.blade.php ENDPATH**/ ?>