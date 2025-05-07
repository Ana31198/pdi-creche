@extends('layouts.navigation')

@section('title', 'Galeria de Fotografias')

@section('content')
<div class="gallery-header">
    <h1 class="text-center">📷 Nossa Galeria</h1>
    <p class="text-center text-light">Momentos inesquecíveis registrados na creche</p>
</div>

<div class="container mt-5" >
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('fotos.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Adicionar Foto
        </a>
    </div>
    <div class="row">
        @foreach($fotos as $foto)
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                    <a href="{{ asset($foto->caminho) }}" data-lightbox="galeria" data-title="{{ $foto->titulo }} - {{ $foto->crianca->nome }}">
                        <img src="{{ asset($foto->caminho) }}" alt="{{ $foto->titulo }}" class="img-fluid card-img-top" style="height: 250px; object-fit: cover;">
                    </a>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $foto->titulo }}</h5>
                        <p class="card-text">👶 {{ $foto->crianca->nome }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

@endsection
