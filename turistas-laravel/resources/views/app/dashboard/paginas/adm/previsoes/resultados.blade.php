 @extends('app.dashboard.layouts.app')
@section('title','Resultados da Previsão')
@section('content')

@php
/*
if($aleatorio<=2500 && $aleatorio>=1000){
$extremo="Baixo";
}else if($aleatorio<=7500 && $aleatorio>2500){
$extremo="Medio";
}else if($aleatorio>7500){
*/
    // Classificação do número de turistas
    if ($extremo=="Pico") {
        $classificacao = 'Pico';
        $badgeColor = 'danger';
        $icon = '🔥';
    } elseif ($extremo=="Medio") {
        $classificacao = 'Médio';
        $badgeColor = 'warning';
        $icon = '⚡';
    } else if($extremo=="Baixo"){
        $classificacao = 'Baixo';
        $badgeColor = 'success';
        $icon = '🌿';
    }
@endphp

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Previsões /</span> Resultados</h4>

        {{-- Parâmetros do usuário --}}
        <div class="card mb-4 shadow-lg border-0 rounded-4" style="background: linear-gradient(145deg, #f5f0ff, #e0e7ff);">
            <div class="card-header bg-primary text-white rounded-top-4">
                <h5 class="mb-0 text-white"><i class="bx bx-info-circle"></i> Parâmetros Informados</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @foreach($data as $key => $value)
                        <div class="col-md-3">
                            <strong>{{ ucfirst(str_replace('_',' ',$key)) }}:</strong>
                            <span class="text-dark">{{ $value }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Número de turistas previsto --}}
        <div class="card mb-4 shadow-lg border-0 rounded-4" style="background: linear-gradient(135deg, #e0f7fa, #ede7f6);">
            <div class="card-body text-center py-5">
                <h2 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">Previsão de Turistas</h2>
                <p class="mb-2 fs-5">Número estimado:</p>
                <h1 class="fw-bold text-primary animate__animated animate__zoomIn">{{ number_format($n_turistas, 2, ',', '.') }}</h1>
                <span class="badge bg-{{ $badgeColor }} fs-5 mt-2 py-2 px-3 animate__animated animate__fadeIn">
                    {{ $icon }} {{ $classificacao }}
                </span>
            </div>
        </div>

        {{-- Sugestão --}}
        @if($sugestao)
            <div class="card mb-4 shadow-lg border-0 rounded-4" style="background: #fff;">
                <div class="card-header bg-secondary text-white rounded-top-4">
                    <h5 class="mb-0 text-white"><i class="bx bx-bulb"></i> Sugestão: {{ $sugestao->nome }}</h5>
                </div>
                <div class="card-body row g-4">
                    @forelse($itens as $item)
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm rounded-4 hover-shadow animate__animated animate__fadeInUp" style="transition: transform 0.3s;">
                                <div class="card-body">
                                    <p class="card-text fs-5">{{ $item->descricao }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Nenhum item de sugestão encontrado.</p>
                    @endforelse
                </div>
            </div>
        @endif

        {{-- Botão voltar --}}
        <div class="text-center mt-4">
            <a href="{{ route('previsoes.create') }}" class="btn btn-outline-primary btn-lg shadow-sm">Nova Previsão</a>
        </div>

    </div>
</div>

{{-- Animate.css e ícones --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fade in suave para todo o conteúdo
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.opacity = 0;
            setTimeout(() => {
                card.style.transition = 'opacity 0.8s ease-in-out, transform 0.3s';
                card.style.opacity = 1;
                card.style.transform = 'translateY(0)';
            }, index * 200);
        });

        // Hover efeito nos cards de itens
        const itemCards = document.querySelectorAll('.hover-shadow');
        itemCards.forEach(card => {
            card.addEventListener('mouseenter', () => card.style.transform = 'translateY(-5px)');
            card.addEventListener('mouseleave', () => card.style.transform = 'translateY(0)');
        });
    });
</script>

@endsection
