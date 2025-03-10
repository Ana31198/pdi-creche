
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title'); ?></title> 
     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <script src="/js/scripts.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="/css/styles.css">
    </head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="/" class="navbar-brand">
        <img src="/img/logotipo.jpeg" alt="PDI-CRECHES" width="100">        
    </a>    

    <!-- Botão para menu responsivo -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav"> 
        <ul class="navbar-nav">
            <li class="nav-item"> 
                <a href="/criancas/create" class="nav-link">Adicionar Criança</a>    
            </li>  
            <li class="nav-item"> 
                <a href="/contact" class="nav-link">Contato</a>    
            </li> 
        </ul> 
    </div>
</nav>

    </header>
    <?php echo $__env->yieldContent('content'); ?>
    <footer>
        PDI--CRECHES &COPY; 2025;
    </footer>
</body>
</html>  <?php /**PATH C:\xampp\htdocs\dashboard\pdi--creches\resources\views/layouts/main.blade.php ENDPATH**/ ?>