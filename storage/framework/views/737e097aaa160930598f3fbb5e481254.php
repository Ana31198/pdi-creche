

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Adicionar Rotina</h2>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary"></h1>
        <a href="<?php echo e(route('rotinas.index')); ?>" class="btn btn-success">Listar Rotinas</a>
    </div>
    <form action="<?php echo e(route('rotinas.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="crianca_id" class="form-label">Criança</label>
            <select name="crianca_id" class="form-control">
                <?php $__currentLoopData = $criancas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crianca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($crianca->id); ?>"><?php echo e($crianca->nome); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" name="data" class="form-control">
        </div>
        <div class="mb-3">
            <label for="atividade" class="form-label">Atividade</label>
            <input type="text" name="atividade" class="form-control">
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\dashboard\creche\resources\views/rotinas/create.blade.php ENDPATH**/ ?>