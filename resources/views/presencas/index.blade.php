
@extends('layouts.navigation')

@section('content')
    <h1 class="criancas">Lista de Presenças</h1>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary"> </h1>
       
        @if(auth()->user()->isEducador())
            <a href="{{ route('presencas.create') }}" class="btn btn-primary mb-3">Registrar Presença</a>
        @endif
        @if(auth()->user()->isAdmin())
        <a href="{{ route('presencas.create') }}" class="btn btn-primary mb-3">Registrar Presença</a>
    @endif
    </div>
    @if($alertas->count() > 0)
        <div class="alert alert-danger mb-4">
            <strong>Atenção!</strong> As seguintes crianças ainda estão na creche após o horário permitido:
            <ul>
                @foreach($alertas as $alerta)
                    <li>{{ $alerta->crianca->nome }} (Entrada: {{ $alerta->hora }})</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Criança</th>
                    <th>Data</th>
                    <th>Hora de Entrada</th>
                    <th>Responsável</th>
                    <th>Hora de Saída</th>
                    <th>Retirado Por</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($presencas as $presenca)
                    <tr>
                        <td>{{ $presenca->crianca->nome }}</td>
                        <td>{{ $presenca->data }}</td>
                        <td>{{ $presenca->hora }}</td>
                        <td>{{ $presenca->responsavel }}</td>
                        <td>
                            @if($presenca->saida)
                                {{ $presenca->saida }}
                            @else
                                <span class="text-danger">Ainda na creche</span>
                            @endif
                        </td>
                        <td>
                            @if($presenca->retirado_por)
                                {{ $presenca->retirado_por }}
                            @else
                                ---
                            @endif
                        </td>
                        <td>
                            @if(!$presenca->saida)
                                <form action="{{ route('presencas.registar_saida', $presenca->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @if(auth()->user()->isEducador())
                                    <input type="text" name="retirado_por" class="form-control form-control-sm mb-2" placeholder="Nome do responsável" required>
                                    <button type="submit" class="btn btn-danger btn-sm">Retirar Criança</button>
                                    @endif
                                    @if(auth()->user()->isAdmin())
                                    <input type="text" name="retirado_por" class="form-control form-control-sm mb-2" placeholder="Nome do responsável" required>
                                    <button type="submit" class="btn btn-danger btn-sm">Retirar Criança</button>
                                    @endif
                                </form>
                                @if(session('error'))
                                    <div class="text-danger mt-2">{{ session('error') }}</div>
                                @endif
                            @else
                                <span class="text-success">✔️ Retirada</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection