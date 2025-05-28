@extends('layouts.navigation')

@section('content')

@php use Illuminate\Support\Str; @endphp

<div class="container mb-5">
    <h1>Lista de Pagamentos</h1>

    @if (auth()->user()->role !== 'responsavel')
        <a href="{{ route('pagamentos.create') }}" class="btn btn-primary mb-4">Novo Pagamento</a>
    @endif

    <table class="table table-bordered mt-4 mb-5">
        <thead>
            <tr>
                <th>Criança</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Estado</th>
                <th>Recibo</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection