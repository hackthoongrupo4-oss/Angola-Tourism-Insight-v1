 @extends('app.ap.app')

@section('content')

@php
    // Closure local para formatar tamanho de ficheiros (evita redeclare)
    $humanFilesize = function($bytes, $decimals = 2) {
        $bytes = (int) ($bytes ?? 0);
        if ($bytes === 0) return '0 B';
        $size = ['B','KB','MB','GB','TB'];
        $factor = floor((strlen((string)$bytes) - 1) / 3);
        if ($factor < 0) $factor = 0;
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . $size[$factor];
    };
@endphp

<!-- HERO SECTION -->
<section class="hero py-5" id="sobre" style="background: linear-gradient(135deg,#f8f7ff,#eef6ff);">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-7">
                <h1 class="display-5 fw-bold">Bem-vindo ao Angola Tourism Insight 🌍</h1>
                <p class="lead text-muted">
                    Uma plataforma inteligente para análise e previsão do turismo em Angola.
                    O sistema fornece informações sobre fluxos turísticos, desempenho regional e
                    projeções baseadas em dados climáticos, económicos e sazonais.
                </p>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg mt-3">Começar Agora</a>
            </div>
            <div class="col-lg-5 text-center">
                <img src="/geral/img/hero-illustration.png" alt="Ilustração" class="img-fluid" style="max-height:260px;">
            </div>
        </div>
    </div>
</section>




 
 <!-- FEATURES SECTION (com Repositório enfatizado) -->
<section class="features py-5" id="funcionalidades">
    <div class="container text-center">
        <h2 class="mb-5 fw-bold text-dark">Funcionalidades Principais</h2>
        <p class="text-muted mb-4">
            Ferramentas para previsão, gestão regional, controlo de acessos e um repositório colaborativo de dados.
        </p>

        <div class="row g-4">
            <!-- Previsão Turística -->
            <div class="col-md-3">
                <div class="feature-box h-100 p-4 border rounded shadow-sm">
                    <i class="bx bx-line-chart display-5 text-primary mb-3"></i>
                    <h5>Previsão Turística</h5>
                    <p class="text-muted small">Analise o fluxo de turistas por província e período, com base em dados históricos e variáveis ambientais.</p>
                </div>
            </div>

            <!-- Gestão de Províncias -->
            <div class="col-md-3">
                <div class="feature-box h-100 p-4 border rounded shadow-sm">
                    <i class="bx bx-map display-5 text-primary mb-3"></i>
                    <h5>Gestão de Províncias</h5>
                    <p class="text-muted small">Visualize o desempenho turístico de cada região e associe gestores a províncias específicas.</p>
                </div>
            </div>

            <!-- Gestão de Usuários -->
            <div class="col-md-3">
                <div class="feature-box h-100 p-4 border rounded shadow-sm">
                    <i class="bx bx-group display-5 text-primary mb-3"></i>
                    <h5>Gestão de Usuários</h5>
                    <p class="text-muted small">Controle de acesso por perfis e permissões, garantindo segurança e gestão eficiente dos dados.</p>
                </div>
            </div>

            <!-- Repositório enfatizado -->
            <div class="col-md-3">
                <div class="feature-box h-100 p-4 border rounded shadow-sm" style="background: linear-gradient(180deg,#fbf8ff,#fff); border-color: rgba(127,109,242,0.12);">
                    <i class="bx bx-folder-open display-5" style="color:#6b5de0; margin-bottom:1rem;"></i>
                    <h5 class="fw-semibold">Repositório & Submissão de Dados</h5>
                    <p class="text-muted small">
                        <strong>Contribua e partilhe</strong> conjuntos de dados (CSV, Excel, PDF, Word).  
                        Submissões passam por revisão e, após aprovação, ficam disponíveis publicamente — suporte essencial para previsões e políticas locais.
                    </p>
                    <div class="mt-2">
                        <a href="" class="btn btn-sm btn-outline-primary">Submeter Dados</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- Explicação sobre o funcionamento do repositório --}}
<section class="py-3">
    <div class="container">
        <div class="alert alert-light border rounded d-flex align-items-center gap-3 mb-0">
            <div class="flex-grow-1">
                <strong>Contribua com dados para o Repositório Nacional de Turismo:</strong>
                <div class="text-muted small mt-1">
                    Este repositório é um espaço colaborativo onde investigadores, instituições públicas e cidadãos 
                    podem <strong>partilhar conjuntos de dados</strong> relevantes para o estudo e gestão do turismo em Angola. 
                    <br>
                    O processo é simples:
                    <ol class="mb-2 mt-2 small text-muted ps-3">
                        <li>Crie uma conta como <strong>prestador</strong> de dados.</li>
                        <li>Carregue os seus ficheiros (<em>CSV, Excel, PDF, Word</em> ou outros formatos compatíveis).</li>
                        <li>A equipa técnica faz uma <strong>verificação e validação</strong> do conteúdo submetido.</li>
                        <li>Após aprovação, o conjunto de dados fica <strong>disponível publicamente</strong> no repositório, para consulta e download.</li>
                    </ol>
                    Este fluxo garante a qualidade das informações partilhadas e promove transparência, 
                    colaboração e apoio à tomada de decisões no setor do turismo.
                </div>
            </div>
            <div class="text-end">
                @guest
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm mb-3">Criar Conta Prestador</a>
                @endguest
                <a href="" class="btn btn-primary btn-sm ms-2">Submeter Dados</a>
            </div>
        </div>
    </div>
</section>
<!-- FILES SECTION (Cards) -->
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Repositório de Arquivos</h3>
                <small class="text-muted">Últimos conjuntos de dados publicados</small>
            </div>
            
        </div>

        @if(isset($arquivos) && $arquivos->count())
            <div class="row g-3">
                @foreach($arquivos as $arquivo)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div>
                                        <h5 class="card-title mb-1">{{ Str::limit($arquivo->titulo, 60) }}</h5>
                                        <div class="small text-muted">Por:
                                            <strong class="text-dark">
                                                {{ $arquivo->prestador?->nome ?? $arquivo->prestador?->user?->name ?? 'Anónimo' }}
                                            </strong>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-{{ $arquivo->status === 'aprovado' ? 'success' : ($arquivo->status === 'arquivado' ? 'secondary' : 'warning') }}">
                                            {{ ucfirst($arquivo->status) }}
                                        </span>
                                    </div>
                                </div>

                                <p class="card-text text-muted mb-3" style="flex:0 0 auto;">
                                    {{ Str::limit($arquivo->descricao ?? '—', 100) }}
                                </p>

                                <ul class="list-unstyled mb-3 small text-muted">
                                    <li><i class="bx bx-hash me-1"></i> <strong>Tamanho:</strong> {{ $humanFilesize($arquivo->size ?? 0) }}</li>
                                    <li><i class="bx bx-calendar me-1"></i> <strong>Enviado:</strong> {{ $arquivo->created_at?->format('d/m/Y') ?? '—' }}</li>
                                </ul>

                                <div class="mt-auto d-flex gap-2">
                                    <a href="{{ route('arquivos.download', $arquivo) }}" class="btn btn-sm btn-primary">
                                        <i class="bx bx-download me-1"></i> Download
                                    </a>

                                    <a href="{{ route('arquivo2.show', $arquivo->id) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bx bx-show me-1"></i> Ver
                                    </a>
 
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{-- Se $arquivos for LengthAwarePaginator --}}
                @if(method_exists($arquivos, 'links'))
                    {{ $arquivos->links('pagination::bootstrap-5') }}
                @endif
            </div>
        @else
            <div class="alert alert-info">
                <strong>Sem arquivos.</strong> Ainda não há conjuntos de dados publicados. Seja o primeiro a <a href="">submeter um conjunto de dados</a>.
            </div>
        @endif
    </div>
</section>

<!-- CONTACT SECTION (mantive, aparece depois dos cards) -->
<section class="py-5 text-center" id="contacto" style="background-color:#f5f3ff;">
    <div class="container">
        <h2 class="fw-bold mb-4">Fale Conosco</h2>
        <p class="mb-4 text-secondary">Quer saber mais sobre o projeto ou colaborar? Entre em contato!</p>
        <a href="mailto:info@angolainsight.com" class="btn btn-primary">Enviar Email</a>
    </div>
</section>

@endsection
