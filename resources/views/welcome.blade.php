@extends('layouts.navigation')
@section('title', 'Bem-vindo')

@section('content')

<div class="container text-center">
    <h1>Bem-vindo à Nossa Creche</h1>
    <p class="lead">
        Uma plataforma inovadora para conectar pais, educadores e a gestão da creche, garantindo transparência, comunicação eficiente e acompanhamento do desenvolvimento infantil.
    </p>
    
    <div class="row mt-4">
        <div class="col-md-4 mb-4"> <!-- Adicionando mb-4 aqui -->
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Comunicação Facilitada</h5>
                    <p class="card-text">Mensagens diretas entre pais e educadores para um acompanhamento próximo da rotina da criança.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4"> <!-- Adicionando mb-4 aqui -->
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Registo Diário</h5>
                    <p class="card-text">Relatórios diários sobre alimentação, atividades e bem-estar do seu filho, acessíveis a qualquer momento.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4"> <!-- Adicionando mb-4 aqui -->
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Gestão Simplificada</h5>
                    <p class="card-text">Facilidade na gestão de matrículas, presenças, pagamentos e documentos da criança, tudo em um só lugar.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-4 mb-4"> <!-- Adicionando mb-4 aqui -->
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Agenda e Eventos</h5>
                    <p class="card-text">Acompanhe o calendário de eventos, reuniões e atividades da creche para estar sempre informado.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4"> <!-- Adicionando mb-4 aqui -->
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Segurança e Privacidade</h5>
                    <p class="card-text">Os dados da sua família são protegidos com as melhores práticas de segurança digital.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4"> <!-- Adicionando mb-4 aqui -->
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Galeria de Momentos</h5>
                    <p class="card-text">Registre e compartilhe fotos e vídeos dos momentos especiais do dia a dia na creche.</p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
