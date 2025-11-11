@extends('app.dashboard.layouts.app')
@section('title','Detalhe da Previsão')
@section('content')

@php
    // classificar por n_turistas (mesma lógica do results)
    if ($historico->nome_sugestao=="Pico") {
        $classificacao = 'Pico';
        $badgeColor = 'danger';
        $icon = '🔥';
    } elseif ($historico->nome_sugestao=="Medio") {
        $classificacao = 'Médio';
        $badgeColor = 'warning';
        $icon = '⚡';
    } else if($historico->nome_sugestao=="Baixo"){
        $classificacao = 'Baixo';
        $badgeColor = 'success';
        $icon = '🌿';
    }


    // garantir arrays para casting seguro
    $params = is_array($historico->data) ? $historico->data : (json_decode($historico->data, true) ?? []);
    $sugestoes = is_array($historico->tipos_sugestoes) ? $historico->tipos_sugestoes : (json_decode($historico->tipos_sugestoes, true) ?? []);
@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Previsões /</span> Histórico — Detalhe</h4>
                <small class="text-muted">Registo em <strong>{{ $historico->created_at?->format('d/m/Y H:i') ?? '—' }}</strong></small>
                <div class="mt-1">
                    <span class="badge bg-secondary">Província: {{ $historico->provincia?->nome ?? '—' }}</span>
                    <span class="badge bg-light text-dark ms-2">Usuário: {{ $historico->user?->name ?? 'Sistema' }}</span>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('previsoes.index') }}" class="btn btn-outline-secondary me-2">
                    <i class="bx bx-arrow-back"></i> Voltar
                </a>

                <a href="" class="btn btn-outline-primary">
                    <i class="bx bx-download"></i> Exportar JSON
                </a>
            </div>
        </div>

        {{-- Top summary --}}
        <div class="row g-3 mb-4">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-4" style="background: linear-gradient(135deg,#f6f5ff,#eef6ff);">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="mb-1 fw-bold">Previsão: <span class="text-primary">{{ number_format($historico->n_turistas ?? 0, 0, ',', '.') }}</span></h3>
                                <p class="mb-1 text-muted">Estimativa de turistas estrangeiros para a província</p>
                                <div class="mt-2">
                                    <span class="badge bg-{{ $badgeColor }} fs-6 py-2 px-3">{{ $icon }} {{ $classificacao }}</span>
                                    <span class="badge bg-white text-dark border ms-2">Registo: {{ $historico->created_at?->format('d/m/Y') ?? '—' }}</span>
                                </div>
                            </div>

                            <div class="text-center">
                                <div style="font-size:42px; line-height:1;"> 
                                    <i class="bx bx-world" style="color:#6b5de0;"></i>
                                </div>
                                <div class="small text-muted mt-1">Fonte: Modelo interno</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick params summary --}}
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 rounded-4 h-100">
                    <div class="card-body p-3">
                        <h6 class="mb-3 fw-semibold"><i class="bx bx-list-ul me-1"></i> Parâmetros Rápidos</h6>

                        <div class="row">
                             <div class="col-6 mb-2"><small class="text-muted">Ano</small><div>{{ $params['ano'] ?? '—' }}</div></div>
                            <div class="col-6 mb-2"><small class="text-muted">Mês</small><div>{{ $params['mes'] ?? '—' }}</div></div>
                              <div class="col-6 mb-2"><small class="text-muted">Precipitação (mm)</small><div>{{ $params['precipitacao'] ?? '—' }}</div></div>
                            <div class="col-6 mb-2"><small class="text-muted">Temperatura média (°C)</small><div>{{ $params['temperatura_media'] ?? '—' }}</div></div>
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#allParams" aria-expanded="false" aria-controls="allParams">
                                Ver todos os parâmetros
                            </button>
                        </div>

                        <div class="collapse mt-3" id="allParams">
                            <div class="p-3 bg-light rounded" style="max-height:260px; overflow:auto;">
                                <pre class="small mb-0">{{ json_encode($params, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sugestões detalhadas --}}
        <div class="card shadow-lg border-0 rounded-4 mb-4">
            <div class="card-header bg-primary text-white rounded-top-4">
                <h5 class="mb-0 text-white"><i class="bx bx-bulb "></i> Sugestões geradas — {{ $historico->nome_sugestao }}</h5>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    @if(count($sugestoes) > 0)
                        @foreach($sugestoes as $idx => $texto)
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm rounded-4 hover-shadow">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div>
                                                <h6 class="mb-2">Sugestão {{ $idx + 1 }}</h6>
                                                <p class="mb-0" style="white-space: pre-line;">{{ $texto }}</p>
                                            </div>
                                            <div class="text-end ms-3">
                                                <span class="badge bg-light text-dark border">{{ $historico->nome_sugestao }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="alert alert-secondary mb-0">Nenhuma sugestão registada para este histórico.</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Ações e meta --}}
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted small">
                Gravado por: <strong>{{ $historico->user?->name ?? 'Sistema' }}</strong> — Província: <strong>{{ $historico->provincia?->nome ?? '—' }}</strong>
            </div>

            <div>
                <a href="{{ route('previsoes.index') }}" class="btn btn-outline-secondary me-2"><i class="bx bx-list-ul"></i> Voltar ao Histórico</a>

                
            </div>
        </div>

    </div>
</div>

{{-- scripts --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // pequenos efeitos de entrada
        document.querySelectorAll('.card').forEach((c, i) => {
            c.style.opacity = 0;
            setTimeout(() => {
                c.style.transition = 'opacity .6s ease, transform .25s ease';
                c.style.opacity = 1;
                c.style.transform = 'translateY(0)';
            }, i * 120);
        });

        document.querySelectorAll('.hover-shadow').forEach(card => {
            card.addEventListener('mouseenter', () => card.style.transform = 'translateY(-6px)');
            card.addEventListener('mouseleave', () => card.style.transform = 'translateY(0)');
        });
    });
</script>

@endsection
