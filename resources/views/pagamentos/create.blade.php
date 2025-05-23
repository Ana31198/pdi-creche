@extends('layouts.navigation')
@section('title', 'Novo Pagamento')


@section('content')
<div class="container">
    <h1>Novo Pagamento</h1>
  <form method="POST" action="{{ route('pagamentos.store') }}">
    @csrf

    <label>Criança</label>
    <select name="crianca_id" required>
        @foreach($criancas as $crianca)
            <option value="{{ $crianca->id }}">{{ $crianca->nome }}</option>
        @endforeach
    </select>

    <label>Valor</label>
    <input type="number" step="0.01" name="valor" required>

    <label>Data do Pagamento</label>
    <input type="date" name="data_pagamento" required>

    <label>Descrição</label>
    <input type="text" name="descricao">

    <label>Estado</label>
    <select name="estado">
        <option value="pendente">Pendente</option>
        <option value="pago">Pago</option>
    </select>

    <button type="submit">Registar Pagamento</button>
</form>
</div>
@endsection
