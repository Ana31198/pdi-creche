@extends('layouts.navigation')

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary mb-4">Lista de Presenças</h1>

    <!-- Exibição do Horário de Funcionamento (visível para Educador) -->
    @if(auth()->user()->isEducador())
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">
            <strong>Horário de Funcionamento</strong>
        </div>
        <div class="card-body">
            <p><strong>Abertura:</strong> {{ $configuracao->hora_abertura ?? 'Não definido' }}</p>
            <p><strong>Fechamento:</strong> {{ $configuracao->hora_fechamento ?? 'Não definido' }}</p>
        </div>
    </div>
    @endif

    <!-- Botão para adicionar uma nova presença -->
    @if(auth()->user()->isEducador())
    <div class="text-right mb-3">
        <a href="{{ route('presencas.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Adicionar Presença
        </a>
    </div>
    @endif
    @if(auth()->user()->isAdmin())
    <div class="text-right mb-3">
        <a href="{{ route('presencas.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Adicionar Presença
        </a>
    </div>
    @endif
    @if(auth()->user()->isAdmin())
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white">
            <strong>Configuração de Horário</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('presencas.horario') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="hora_abertura">Hora de Abertura</label>
                        <input type="time" id="hora_abertura" name="hora_abertura" class="form-control" 
                               value="{{ old('hora_abertura', $configuracao->hora_abertura ?? '') }}">
                        <small class="text-muted">Nao mexer para manter o horário atual.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="hora_fechamento">Hora de Fechamento</label>
                        <input type="time" id="hora_fechamento" name="hora_fechamento" class="form-control" 
                               value="{{ old('hora_fechamento', $configuracao->hora_fechamento ?? '') }}">
                        <small class="text-muted">Nao mexer para manter o horário atual.</small>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Horário</button>
            </form>
        </div>
    </div>
    @endif

    <!-- Alerta de Crianças Ainda na Creche -->
    @php
        $alertas = $alertas ?? collect([]);
    @endphp

    @if($alertas->count() > 0)
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <strong>Atenção!</strong> As seguintes crianças ainda estão na creche após o horário permitido:
            <ul>
                @foreach($alertas as $alerta)
                    <li>{{ $alerta->crianca->nome }} (Entrada: {{ $alerta->hora }})</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Tabela de Presenças -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
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
                    <tr class="{{ $presenca->saida ? 'table-success' : 'table-warning' }}">
                        <td>{{ $presenca->crianca->nome }}</td>
                        <td>{{ $presenca->data }}</td>
                        <td>{{ $presenca->hora }}</td>
                        <td>{{ $presenca->responsavel }}</td>
                        <td>
                            @if($presenca->saida)
                                <span class="text-success">{{ $presenca->saida }}</span>
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
                                @if(auth()->user()->isEducador() || auth()->user()->isAdmin()) <!-- Permite a retirada para educador ou administrador -->
                                    <form action="{{ route('presencas.registar_saida', $presenca->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="text" name="retirado_por" class="form-control form-control-sm mb-2" placeholder="Nome do responsável" required>
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-sign-out-alt"></i> Retirar Criança
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">Somente o educador ou administrador pode registrar a retirada da criança.</span>
                                @endif
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
</div>
@endsection

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-success {
            font-size: 14px;
        }
        .alert-warning {
            background-color: #fff3cd;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .table-success {
            background-color: #d4edda !important;
        }
        .table-warning {
            background-color: #fff3cd !important;
        }
    </style>
@endsection