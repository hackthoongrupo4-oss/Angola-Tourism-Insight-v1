 @extends('app.dashboard.layouts.app')

@section('title', 'Planos')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-4 mt-3">
            <h3 class="fw-bold text-center">Planos Disponíveis</h3>
        </div>

        @foreach($planos as $plano)
            @php
                $planoAtualId = $assinatura?->plano_id ?? $planos->first()->id;
                $isPlanoAtual = $plano->id === $planoAtualId;
                $nivel = $plano->nivel;
                $isGratuito = $nivel == 0;
                $isBasico = $nivel == 1;
                $isPremium = $nivel == 2;

                $badge = $isPlanoAtual ? 'Plano Atual' : ($isGratuito ? 'Gratuito' : ($isBasico ? 'Mais Popular' : ($isPremium ? 'Melhor Valor' : '')));
                $badgeColor = $isPlanoAtual ? 'dark' : ($isGratuito ? 'success' : ($isBasico ? 'info' : ($isPremium ? 'warning' : 'primary')));
                $cardClass = 'border-' . $badgeColor;
                $titleClass = 'text-' . $badgeColor;
            @endphp

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 {{ $cardClass }}">
                    <div class="card-body">
                        <div class="text-end mb-2">
                            <span class="badge bg-{{ $badgeColor }}">{{ $badge }}</span>
                        </div>

                        <h4 class="card-title {{ $titleClass }}">{{ $plano->nome }}</h4>
                        <h5 class="card-subtitle mb-2 text-muted">{{ number_format($plano->preco, 2, ',', '.') }} Kz</h5>
  <p class="card-text mt-2">
                            {{ $plano->descricao ?? 'Sem descrição fornecida.' }}
                        </p>
                        <ul class="list-group list-group-flush mt-3">
                            <li class="list-group-item">Serviços/30 dias: <strong>{{ $plano->limite_servicos }}</strong></li>
                            <li class="list-group-item">Imagens/serviço: <strong>{{ $plano->limite_imagens }}</strong></li>
                            <li class="list-group-item">Destaques?: <strong>{{ $plano->limite_destaque ? 'Sim' : 'Não' }}</strong></li>
                        </ul>

                        <div class="mt-4 text-center">
                            @if(!$isPlanoAtual && !$isGratuito)
                                <a href=""  data-bs-toggle="modal" data-bs-target="#assinar{{ $plano->id }}" class="btn btn-outline-primary mb-2">Subscrever</a>
                            
                            @endif

                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalInfo{{ $plano->id }}">
                                Mais info
                            </button>
                        </div>
                    </div>

                    <div class="card-footer text-muted text-center small">
                        Código: {{ $plano->slug }}
                    </div>
                </div>
            </div>


     <!-- MODAL DE INFORMAÇÕES COMPLETAS DO PLANO -->
            <div class="modal fade" id="assinar{{ $plano->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $plano->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel{{ $plano->id }}"><strong>Polticas Sobre Assinatura De Um Plano</strong></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
<form action="{{ route('plano.assinar.create', $plano->slug) }}" method="GET">
                            <h6 class="fw-bold mb-2">📦 Detalhes</h6>
                            <ul class="list-group mb-4">
                                <li class="list-group-item">Assinatura de todos os planos faz-se por um <strong>codigo de recarga!</strong> </li>
                                <li class="list-group-item">Para  adquirir o código de recarga é só ligar em     <a href="tel:+244{{ $empresa->telefone1 ?? '938531896' }}" class="align-items-center text-decoration-none contato-link">
            <i class="fa fa-phone me-2"></i> +244 {{ $empresa->telefone1 ?? '938531896' }}
        </a> ou   nosso whatssap :   <a href="https://wa.me/244{{ $empresa->telefone2 ?? '938531896' }}?text={{ urlencode('Olá, pretendo adquirir o código de recarga do plano "' . $plano->nome ) }}" target="_blank" class="align-items-center text-decoration-none contato-link">
            <i class="fa fa-whatsapp me-2"></i> +244 {{ $empresa->telefone2 ?? '938531896' }}
        </a> </li>
                                <li class="list-group-item">Assinatura de um plano tem duração de <strong>30</strong>  dias !</li>
                                <li class="list-group-item">Depois da data de expiração, o usuario é rebaixado para o <strong>plano gratís !</strong> .</li>
                                <li class="list-group-item">Se o usuario já tiver um plano ativo e assinar um plano de um outro tipo,<strong>o plano anterior é cancelado automaticamente!</strong> </li>
                                 <li class="list-group-item">Em caso de duvida entre em contato com os contatos acima.</li>
                                </ul>



                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Concordo</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não concordo</button>

                        </div>
                       
                        </form>
                        </div>
                        
                    </div>
                </div>
            </div>
    






            <!-- MODAL DE INFORMAÇÕES COMPLETAS DO PLANO -->
            <div class="modal fade" id="modalInfo{{ $plano->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $plano->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel{{ $plano->id }}">Informações completas do plano: <strong>{{ $plano->nome }}</strong></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <h6 class="fw-bold mb-2">📦 Detalhes do Plano</h6>
                            <ul class="list-group mb-4">
                                <li class="list-group-item"><strong>Nome:</strong> {{ $plano->nome }}</li>
                                <li class="list-group-item"><strong>Descrição:</strong> {{ $plano->descricao ?? 'Não disponível' }}</li>
                                <li class="list-group-item"><strong>Preço:</strong> {{ number_format($plano->preco, 2, ',', '.') }} Kz</li>
                                <li class="list-group-item"><strong>Limite de Serviços / 30 dias:</strong> {{ $plano->limite_servicos }}</li>
                                <li class="list-group-item"><strong>Limite de Imagens por Serviço:</strong> {{ $plano->limite_imagens }}</li>
                                <li class="list-group-item"><strong>Limite de Destaques:</strong> {{ $plano->limite_destaque ?? 'Nenhum' }}</li>
                            </ul>

                            @if($plano->tipoDestaque)
                                <h6 class="fw-bold mb-2">⭐ Informações do Tipo de Destaque</h6>
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Tipo:</strong> {{ $plano->tipoDestaque->nome }}</li>
                                    <li class="list-group-item"><strong>Duração:</strong> {{ $plano->tipoDestaque->duracao_dias }} dias</li>
                                    <li class="list-group-item"><strong>Mostrar na Home:</strong> {{ $plano->tipoDestaque->mostrar_home ? 'Sim' : 'Não' }}</li>
                                    <li class="list-group-item"><strong>Topo da Categoria:</strong> {{ $plano->tipoDestaque->topo_categoria ? 'Sim' : 'Não' }}</li>
                                    <li class="list-group-item"><strong>Ícone de Destaque:</strong> {{ $plano->tipoDestaque->icone_destaque ? 'Sim' : 'Não' }}</li>
                                    
                                </ul>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if($planos->isEmpty())
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Nenhum plano disponível no momento.
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
