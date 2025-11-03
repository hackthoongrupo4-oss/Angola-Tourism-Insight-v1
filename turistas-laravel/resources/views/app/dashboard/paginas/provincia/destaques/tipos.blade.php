@extends('app.dashboard.layouts.app')

@section('title', 'Tipos de Destaque')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-4 mt-3">
            <h3 class="fw-bold text-center">Tipos de Destaque Disponíveis</h3>
        </div>

        @foreach($tiposDestaque as $destaque)
            @php
                // Etiquetas dinâmicas para destacar os tipos
                $isHome = $destaque->mostrar_home;
                $isTopo = $destaque->topo_categoria;
                $isIcone = $destaque->icone_destaque;

                $badge = $isHome ? 'Exibe na Home' : ($isTopo ? 'Topo de Categoria' : ($isIcone ? 'Com Ícone' : 'Padrão'));
                $badgeColor = $isHome ? 'success' : ($isTopo ? 'warning' : ($isIcone ? 'info' : 'secondary'));
                $cardClass = 'border-' . $badgeColor;
                $titleClass = 'text-' . $badgeColor;
            @endphp

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 {{ $cardClass }}">
                    <div class="card-body">
                        <div class="text-end mb-2">
                            <span class="badge bg-{{ $badgeColor }}">{{ $badge }}</span>
                        </div>

                        <h4 class="card-title {{ $titleClass }}">{{ $destaque->nome }}</h4>
                        <h6 class="card-subtitle mb-2 text-muted">{{ number_format($destaque->preco, 2, ',', '.') }} Kz</h6>

                        <ul class="list-group list-group-flush mt-3">
                            <li class="list-group-item">Duração: <strong>{{ $destaque->duracao_dias }} dias</strong></li>
                            <li class="list-group-item">Mostrar na Home: <strong>{{ $destaque->mostrar_home ? 'Sim' : 'Não' }}</strong></li>
                            <li class="list-group-item">Topo da Categoria: <strong>{{ $destaque->topo_categoria ? 'Sim' : 'Não' }}</strong></li>
                            <li class="list-group-item">Ícone de Destaque: <strong>{{ $destaque->icone_destaque ? 'Sim' : 'Não' }}</strong></li>
                            <li class="list-group-item">Inclui Estatísticas: <strong>{{ $destaque->inclui_estatisticas ? 'Sim' : 'Não' }}</strong></li>
                        </ul>

                      
                    </div>

                    <div class="card-footer text-muted text-center small">
                        Código: {{ $destaque->slug }}
                    </div>
                </div>
            </div>

           
        @endforeach

        @if($tiposDestaque->isEmpty())
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Nenhum tipo de destaque disponível no momento.
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
