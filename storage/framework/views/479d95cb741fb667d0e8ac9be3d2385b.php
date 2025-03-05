<?php $__env->startSection('title','Creche'); ?>
<?php $__env->startSection('content'); ?>

<div id="search-container" class="col-md-12">
        <h1>Pesquise uma criança</h1>
        <form action="">
                <input type="text" id="search" name="search" class="form-control" placeholder="Pesquise uma criança">
        </form>
</div>

<div class="container">
        <h1 class="mb-4">Lista de Crianças</h1>
        <div class="d-flex justify-content-between align-items-center mb-4">
    
            <a href="<?php echo e(route('criancas.create')); ?>" class="btn btn-success">Adicionar uma nova crianca</a>
        </div>
        <div class="row">
            <?php $__currentLoopData = $criancas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crianca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                    <div class="card shadow-lg mb-3">
                        <div class="card-body">
                            <img src="<?php echo e(asset($crianca->image)); ?>" alt="<?php echo e($crianca->nome); ?>" class="img-fluid fixed-size-image">

                            <h5 class="card-title"><?php echo e($crianca->nome); ?></h5>
                            <p class="card-text">
                                <strong>Gênero:</strong> <?php echo e($crianca->genero); ?> <br>
                                <strong>Data de Nascimento:</strong> <?php echo e(date('d/m/Y', strtotime($crianca->data_nascimento))); ?> <br>
                                <strong>Responsável:</strong> <?php echo e($crianca->nomeresponsavel); ?> <br>
                                <strong>Grau do responsável:</strong> <?php echo e($crianca->graudeparentescodoresponsavel); ?> <br>
                                <strong>Contato:</strong> <?php echo e($crianca->contactodoresponavel); ?>

                                <a href="#" class="btn btn-primary"> Saber mais </a>
                            </p>
                            <div class="d-flex justify-content-between">
                           
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\dashboard\creche\resources\views/welcome.blade.php ENDPATH**/ ?>