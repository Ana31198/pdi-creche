@extends('layouts.navigation')

@section('content')
<div class="container">
    <h2>Pagamento Pendente</h2>
    <p><strong>Criança:</strong> {{ $pagamento->crianca->nome }}</p>
    <p><strong>Valor:</strong> {{ number_format($pagamento->valor, 2, ',', '.') }} €</p>
    <p><strong>Descrição:</strong> {{ $pagamento->descricao }}</p>

    <form method="POST" action="{{ route('pagamentos.confirmar', $pagamento->id) }}">
        @csrf
        <button type="submit" class="btn btn-success">Confirmar Pagamento</button>
    </form>
</div>
@endsection