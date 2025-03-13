
@extends('layouts.navigation')
@section('title','Contact')
@section('content')


<div class="col-md-6">
    <h3>Informações</h3>
    <p><strong>Morada:</strong> </p>
    <p><strong>Telefone:</strong> </p>
    <p><strong>Email:</strong> </p>
    <p><strong>Horário de Funcionamento:</strong> Segunda a Sexta, 08:00 - 17:00</p>
    
    <!-- Mapa Integrado -->
    <div class="mt-3">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3162.9167848538075!2d-122.08424968469243!3d37.42206597982583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb0b1c4a25e3b%3A0x7e3d7b7e7c3c3f6b!2sGoogleplex!5e0!3m2!1spt-BR!2sbr!4v1589299265634!5m2!1spt-BR!2sbr" 
                width="100%" 
                height="250" 
                frameborder="0" 
                style="border:0;" 
                allowfullscreen="" 
                aria-hidden="false" 
                tabindex="0">
        </iframe>
    </div>
</div>


@endsection