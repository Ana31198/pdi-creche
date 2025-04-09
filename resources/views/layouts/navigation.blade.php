<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- boodstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <!-- css da aplicacao -->
    <link rel="stylesheet" href="\css\styles.css">
    <!-- scripts da aplciacao-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>  <script src="\js\scripts.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <img src="/imgs/logotipo.jpeg" alt="Logotipo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="/criancas">Crianças</a></li>
                        <li class="nav-item"><a class="nav-link" href="/rotinas">Rotinas</a></li>
                        <li class="nav-item"><a class="nav-link" href="/presencas">Presenças</a></li>
                        <li class="nav-item"><a class="nav-link" href="/fotos">Fotografias</a></li>
                        <li class="nav-item"><a class="nav-link" href="/contact">Contacto</a></li>
                        @guest
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registar</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Entrar</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="dropdown-item" type="submit">Sair</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
     

    </header>

    @yield('content')       
    <footer>
         <p> 2025 &copy; Creches Ana Simoes </p>
    </footer>
</body>
</html>