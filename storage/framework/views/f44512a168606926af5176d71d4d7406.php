
<?php $__env->startSection('title', 'Adicionar Criança'); ?>
<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Adicionar Criança</h1>
        <a href="<?php echo e(route('criancas.index')); ?>" class="btn btn-secondary">Ver Lista criancas</a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">
            <form action="<?php echo e(route('criancas.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="image" class="form-label">Imagem da Criança</label>
                    <input type="file" id="image" name="image" class="form-control-file">
                </div>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome da Criança</label>
                    <input type="text" id="nome" name="nome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="genero" class="form-label">Gênero</label>
                    <select id="genero" name="genero" class="form-control" required>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nomeresponsavel" class="form-label">Nome do Responsável</label>
                    <input type="text" id="nomeresponsavel" name="nomeresponsavel" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="graudeparentescodoresponsavel" class="form-label">Grau de Parentesco</label>
                    <select id="graudeparentescodoresponsavel" name="graudeparentescodoresponsavel" class="form-control" required>
                        <option value="Pai">Pai</option>
                        <option value="Mae">Mae</option>
                        <option value="Tio">Tio</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="contactodoresponavel" class="form-label">Contato do Responsável</label>
                    <input type="text" id="contactodoresponavel" name="contactodoresponavel" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Adicionar Criança</button>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\dashboard\creche\resources\views/criancas/create.blade.php ENDPATH**/ ?>