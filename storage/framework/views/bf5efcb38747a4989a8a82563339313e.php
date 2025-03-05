

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1>Registrar Presença</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary"></h1>
        <a href="<?php echo e(route('presencas.index')); ?>" class="btn btn-success">Ver crianças na creche</a>
    </div>
    <form action="<?php echo e(route('presencas.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        
        <div class="mb-3">
            <label for="crianca_id" class="form-label">Criança</label>
            <select name="crianca_id" class="form-control" required>
                <?php $__currentLoopData = $criancas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crianca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($crianca->id); ?>"><?php echo e($crianca->nome); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" name="data" class="form-control" value="<?php echo e(old('data', date('Y-m-d'))); ?>" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Registo</label>
            <select name="tipo" class="form-control" required>
                <option value="entrada">Entrada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" name="hora" class="form-control" value="<?php echo e(old('hora')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="responsavel" class="form-label">Responsável</label>
            <input type="text" name="responsavel" class="form-control" value="<?php echo e(old('responsavel')); ?>" required>
        </div>
        
        <button type="submit" class="btn btn-success">Registrar</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const criancaSelect = document.querySelector('select[name="crianca_id"]');
        const responsavelInput = document.querySelector('input[name="responsavel"]');
        
        const criancas = <?php echo json_encode($criancas, 15, 512) ?>;
        
        criancaSelect.addEventListener('change', function() {
            const selectedCriancaId = criancaSelect.value;
            const selectedCrianca = criancas.find(crianca => crianca.id == selectedCriancaId);
            responsavelInput.value = selectedCrianca ? selectedCrianca.nomeresponsavel : '';
        });
    });
</script>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\dashboard\creche\resources\views/presencas/create.blade.php ENDPATH**/ ?>