@extends('layouts.main')
@section('title','Creche')
@section('content')

<div id="search-container" class="col-md-12">
        <h1>Pesquise uma criança</h1>
        <form action="">
                <input type="text" id="search" name="search" class="form-control" placeholder="Pesquise uma criança">
        </form>
</div>

<div class="container">
        <h1 class="mb-4">Lista de Crianças</h1>
        <div class="d-flex justify-content-between align-items-center mb-4">
    
            <a href="{{ route('criancas.create') }}" class="btn btn-success">Adicionar uma nova crianca</a>
        </div>
        <div class="row">
            @foreach($criancas as $crianca)
                <div class="col-md-3">
                    <div class="card shadow-lg mb-3">
                        <div class="card-body">
                            <img src="{{ asset($crianca->image) }}" alt="{{ $crianca->nome }}" class="img-fluid fixed-size-image">

                            <h5 class="card-title">{{ $crianca->nome }}</h5>
                            <p class="card-text">
                                <strong>Gênero:</strong> {{ $crianca->genero }} <br>
                                <strong>Data de Nascimento:</strong> {{ date('d/m/Y', strtotime($crianca->data_nascimento)) }} <br>
                                <strong>Responsável:</strong> {{ $crianca->nomeresponsavel }} <br>
                                <strong>Grau do responsável:</strong> {{ $crianca->graudeparentescodoresponsavel }} <br>
                                <strong>Contato:</strong> {{ $crianca->contactodoresponavel }}
                                <a href="#" class="btn btn-primary"> Saber mais </a>
                            </p>
                            <div class="d-flex justify-content-between">
                           
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    
@endsection
