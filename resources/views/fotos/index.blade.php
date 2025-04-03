@extends('layouts.navigation')

@section('title', 'Galeria de Fotografias')

@section('content')
<div class="gallery-header">
    <h1 class="text-center">📷 Nossa Galeria</h1>
    <p class="text-center text-light">Momentos inesquecíveis registrados na creche</p>
</div>

<div class="container mt-5">
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('fotos.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Adicionar Foto
        </a>
    </div>

    <div class="gallery-grid">
        @foreach($fotos as $foto)
            <div class="gallery-item">
                <a href="{{ asset('storage/' . $foto->caminho) }}" 
                   data-lightbox="galeria" 
                   data-title="{{ $foto->titulo }} - {{ $foto->crianca->nome }}"
                   data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $foto->titulo }} - {{ $foto->crianca->nome }}">
                    <img src="{{ asset('storage/' . $foto->caminho) }}" class="img-fluid img-hover" alt="{{ $foto->titulo }}">
                </a>
                <div class="gallery-info">
                    <h5>{{ $foto->titulo }}</h5>
                    <p>👶 {{ $foto->crianca->nome }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Estilos -->
<style>
    /* Cabeçalho de Galeria */
    .gallery-header {
        background: url('https://source.unsplash.com/1600x400/?kids,play') no-repeat center center;
        background-size: cover;
        text-align: center;
        padding: 80px 20px;
        color: white;
        position: relative;
    }
    .gallery-header::after {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.5);
    }
    .gallery-header h1, .gallery-header p {
        position: relative;
        z-index: 1;
    }

    /* Estilo da Grid de Galeria */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
        padding: 20px;
    }
    
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }
    
    .gallery-item:hover {
        transform: scale(1.05);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        transition: opacity 0.3s ease-in-out;
    }

    .gallery-item:hover img {
        opacity: 0.8;
    }

    /* Informações da Foto */
    .gallery-info {
        background: rgba(0, 0, 0, 0.7);
        color: white;
        text-align: center;
        padding: 10px;
        border-radius: 0 0 10px 10px;
    }
</style>

<!-- Lightbox e Scripts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>
    // Configuração para os tooltips, se necessário
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

@endsection
