@extends('layouts.navigation')

@section('content')
    <h1>Galeria de {{ $crianca->nome }}</h1>

    <form action="{{ route('fotografias.store', $crianca->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="foto" required>
        <button type="submit">Carregar Fotografia</button>
    </form>

    <h2>Fotografias</h2>
    <div style="display: flex; flex-wrap: wrap;">
        @foreach ($fotografias as $foto)
            <div style="margin: 10px; text-align: center;">
                <img src="{{ asset('storage/' . $foto->caminho) }}" width="150" height="150">
                <form action="{{ route('fotografias.destroy', $foto->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
