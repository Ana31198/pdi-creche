<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Recibo de Pagamento</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Recibo de Pagamento</h1>
    <p><strong>Criança:</strong> {{ $pagamento->crianca->nome }}</p>
    <p><strong>Descrição:</strong> {{ $pagamento->descricao }}</p>
    <p><strong>Valor:</strong> {{ $pagamento->valor }} €</p>
    <p><strong>Estado:</strong> {{ $pagamento->estado }}</p>
    <p><strong>Data:</strong> {{ $pagamento->created_at->format('d/m/Y') }}</p>
</body>
</html>
