
<?php $__env->startSection('title', 'Lista de Crianças'); ?>
<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Lista de Crianças</h1>
        <a href="<?php echo e(route('criancas.create')); ?>" class="btn btn-success">Adicionar Nova Criança</a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">
            <?php if($criancas->isEmpty()): ?>
                <p class="text-muted text-center">Ainda não há crianças registradas.</p>
            <?php else: ?>
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Responsável</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $criancas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crianca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php if($crianca->image): ?>
                                        <img src="<?php echo e(asset('storage/'.$crianca->image)); ?>" alt="<?php echo e($crianca->nome); ?>" width="50">
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/50" alt="<?php echo e($crianca->nome); ?>">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($crianca->nome); ?></td>
                                <td><?php echo e(date('d/m/Y', strtotime($crianca->data_nascimento))); ?></td>
                                <td><?php echo e($crianca->nomeresponsavel); ?></td>
                                <td>
                                    <a href="<?php echo e(route('criancas.edit', $crianca->id)); ?>" class="btn btn-sm btn-primary">Editar</a>
                                    <form action="<?php echo e(route('criancas.destroy', $crianca->id)); ?>" method="POST" style="display:inline-block;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\dashboard\creche\resources\views/criancas/show.blade.php ENDPATH**/ ?>