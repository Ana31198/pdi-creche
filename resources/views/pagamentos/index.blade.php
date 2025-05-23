@extends('layouts.navigation')

@section('content')

@php use Illuminate\Support\Str; @endphp

<div class="container">
    <h1>Lista de Pagamentos</h1>

    @if (auth()->user()->role !== 'responsavel')
        <a href="{{ route('pagamentos.create') }}" class="btn btn-primary mb-3">Novo Pagamento</a>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Criança</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Estado</th>
                <th>Recibo</th>
                @if (auth()->user()->role !== 'responsavel')
                    <th>Ações</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($pagamentos as $pagamento)
                <tr>
                    <td>{{ $pagamento->crianca->nome ?? 'N/D' }}</td>
                    <td>{{ $pagamento->descricao }}</td>
                    <td>{{ number_format($pagamento->valor, 2, ',', '.') }} €</td>
                    <td class="{{ $pagamento->estado === 'pago' ? 'text-success' : 'text-danger' }}">
                        {{ ucfirst($pagamento->estado) }}
                    </td>
                    <td>
                        @php
                            $user = auth()->user();
                            $crianca = $pagamento->crianca;

                            $podeVerRecibo = $user->role === 'admin' ||
                                             $user->role === 'educador' ||
                                             ($user->role === 'responsavel' &&
                                              $crianca &&
                                              trim(mb_strtolower($crianca->nomeresponsavel)) === trim(mb_strtolower($user->name)));
                        @endphp

                        @if ($podeVerRecibo)
                            <a href="{{ route('pagamentos.recibo', $pagamento) }}" class="btn btn-sm btn-outline-secondary">PDF</a>
                        @endif
                    </td>
                    @if (auth()->user()->role !== 'responsavel')
                        <td>
                            @if ($pagamento->estado === 'pendente')
                                <form action="{{ route('pagamentos.marcarPago', $pagamento->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">Marcar como Pago</button>
                                </form>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection