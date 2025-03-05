<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <!-- boodstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- css da aplicacao -->
    <link rel="stylesheet" href="/css/styles.css">
    <!-- scrpts da aplciacao-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="/js/scripts.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
            <div class="container-fluid">
              <a class="navbar-brand" href="/">
                <img src="/img/logotipo.jpeg" alt="Logotipo" >
              </a>  
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" 
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/criancas">  Criancas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/rotinas">Rotinas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/presencas"> Presencas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/contact">Contacto</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="">Registar</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="">Entrar</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>    
    </header>
    <?php echo $__env->yieldContent('content'); ?>       
    <footer>
         <p> 2025 &copy; Creches Ana Simoes Carolina Pereira</p>
    </footer>
</body>
</html><?php /**PATH C:\xampp\htdocs\dashboard\creche\resources\views/layouts/main.blade.php ENDPATH**/ ?>