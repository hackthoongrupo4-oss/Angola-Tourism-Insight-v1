 @extends('app.dashboard.layouts.app')

@section('title', 'Plano Ativo')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            @php
                $plano = $assinatura->plano;
                $slug = strtolower(trim($plano->slug ?? ''));
                $preco = $plano->preco ?? 0;
                $tipoDestaque = $plano->tipoDestaque ?? null;

                   $nivel = $plano->nivel;
                $isGratuito = $nivel == 0;
                $isBasico = $nivel == 1;
                $isPremium = $nivel == 2;

                $badgeColor = $isGratuito ? 'success' : ($isPremium ? 'warning' : ($isBasico ? 'info' : 'primary'));
                $badgeNome = $isGratuito ? 'Plano Gratuito' : ($isPremium ? 'Plano Premium' : ($isBasico ? 'Plano Básico' : $plano->nome));
            @endphp

            <div class="card shadow border-{{ $badgeColor }}">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-{{ $badgeColor }}">Seu Plano Ativo</h4>
                    <span class="badge bg-{{ $badgeColor }}">{{ $badgeNome }}</span>
                </div>

                <div class="card-body">
                    {{-- SEÇÃO 1: DETALHES DO PLANO --}}
                    <h5 class="fw-bold mb-3">📦 Informações do Plano</h5>
                    <ul class="list-group mb-4">
                        <li class="list-group-item"><strong>Nome:</strong> {{ $plano->nome }}</li>
                        <li class="list-group-item"><strong>Preço:</strong> {{ number_format($preco, 2, ',', '.') }} Kz</li>
                        <li class="list-group-item"><strong>Descrição:</strong> {{ $plano->descricao ?? 'Sem descrição' }}</li>
                        <li class="list-group-item"><strong>Limite de Serviços :  </strong> {{ $plano->limite_servicos }}</li>
                        <li class="list-group-item"><strong>Limite de Imagens por Serviço:</strong> {{ $plano->limite_imagens }}</li>
                    </ul>
                     @php
                    $tipoDestaque=$plano->tipoDestaque;
                    @endphp
                    {{-- SEÇÃO 2: TIPO DE DESTAQUE (SE TIVER) --}}
                    @if($tipoDestaque)
                        <h5 class="fw-bold mb-3">⭐ Destaques Permitidos pelo Plano</h5>
                        <ul class="list-group mb-4">
                            <li class="list-group-item"><strong>Tipo de Destaque:</strong> {{ $tipoDestaque->nome }}</li>
                            <li class="list-group-item"><strong>Duração:</strong> {{ $tipoDestaque->duracao_dias }} dias</li>
                            <li class="list-group-item"><strong>Limite de Destaques:</strong> {{ $plano->limite_destaque ?? 'Não definido' }}</li>
                            <li class="list-group-item"><strong>Mostrar na Home:</strong> {{ $tipoDestaque->mostrar_home ? 'Sim' : 'Não' }}</li>
                            <li class="list-group-item"><strong>Topo da Categoria:</strong> {{ $tipoDestaque->topo_categoria ? 'Sim' : 'Não' }}</li>
                            <li class="list-group-item"><strong>Ícone de Destaque:</strong> {{ $tipoDestaque->icone_destaque ? 'Sim' : 'Não' }}</li>
                       
                        </ul>
                    @endif

                    {{-- SEÇÃO 3: DETALHES DA ASSINATURA --}}
                    <h5 class="fw-bold mb-3">📅 Detalhes da Assinatura</h5>

                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>Data de Início do plano:</strong> {{\Carbon\Carbon::parse($assinatura->data_inicio) ->format('d/m/Y H:i') }}</li>
                  
                    <li class="list-group-item">
                        <strong>Data de Fim do plano:</strong>
                        {{ $assinatura->data_fim ? \Carbon\Carbon::parse( $assinatura->data_fim)->format('d/m/Y ') : 'Plano Gratuito (Sem fim)' }}
                    </li>
                   
                   <li class="list-group-item"><strong>Status:</strong>
                            @if($assinatura->status === 'ativa')
                                <span class="text-success fw-bold">Ativa</span>
                            @elseif($assinatura->status === 'expirada')
                                <span class="text-warning fw-bold">Expirada</span>
                            @else
                                <span class="text-danger fw-bold">Cancelada</span>
                            @endif
                  </li>
                
                </ul>

                   
                     
                    
                </div>

                <div class="card-footer text-muted text-center small">
                    @if($isGratuito)
                        Este é o plano gratuito padrão. Atualize para desbloquear mais recursos.
                    @elseif($isBasico)
                        Ideal para começar e explorar a plataforma.
                    @elseif($isPremium)
                        Você tem acesso total aos recursos premium!
                    @else
                        Este plano foi personalizado para suas necessidades.
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
