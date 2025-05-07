<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registar - Creche Ana Simões</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f8fa;
        }
        .register-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .register-card {
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }
        .logo {
            max-width: 80px;
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <div class="register-card">
            <div class="text-center mb-4">
                <img src="/imgs/logotipo.jpeg" alt="Logotipo" class="logo mb-2">
                <h4 class="fw-bold">Criar Conta</h4>
                <p class="text-muted">Preencha os dados para se registar.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

      
                <div class="mb-3">
                    <label for="password" class="form-label">Palavra-passe</label>
                    <input id="password" type="password" name="password" class="form-control" required>
                    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

        
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Palavra-passe</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                    @error('password_confirmation') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">Função</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="educador" {{ old('role') == 'educador' ? 'selected' : '' }}>Educador</option>
                        <option value="responsavel" {{ old('role') == 'responsavel' ? 'selected' : '' }}>Responsável</option>
                    </select>
                    @error('role') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('login') }}" class="text-decoration-none">Já tem conta?</a>
                    <button type="submit" class="btn btn-primary">Registar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
