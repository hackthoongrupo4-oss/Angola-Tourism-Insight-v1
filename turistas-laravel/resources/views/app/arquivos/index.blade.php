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

<style>
    /* Small design polish for cards and filters */
    .repo-header { display:flex; align-items:center; justify-content:space-between; gap:12px; }
    .card-repo { border-radius:12px; transition: transform .18s ease, box-shadow .18s ease; overflow: hidden; }
    .card-repo:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(61,46,131,0.12); }
    .badge-status { font-weight:600; text-transform:capitalize; }
    .file-meta { font-size:.92rem; color:#5a5380; }
    .feature-icon { width:44px; height:44px; display:inline-flex; align-items:center; justify-content:center; border-radius:10px; color:#fff; }
    .feature-icon.lilac { background: linear-gradient(135deg,#7f6df2,#6b5de0); box-shadow:0 8px 22px rgba(107,93,224,0.12); }
    .filter-box { gap:.5rem; display:flex; align-items:center; flex-wrap:wrap; }
    @media (max-width:576px){ .repo-header { flex-direction:column; align-items:flex-start } }
</style>

<!-- FILES SECTION (Cards) -->
<section class="py-5">
    <div class="container">

        <!-- header + controls -->
        <div class="repo-header mb-4">
            <div>
                <h3 class="fw-bold mb-0">Repositório de Arquivos</h3>
                <small class="text-muted">Últimos conjuntos de dados publicados</small>
            </div>

            <div class="d-flex align-items-center filter-box">
                <div class="me-2">
                    <input id="searchInput" type="search" class="form-control form-control-sm" placeholder="Pesquisar título ou prestador...">
                </div>

                <div class="me-2">
                    <select id="statusFilter" class="form-select form-select-sm">
                        <option value="all">Todos os status</option>
                        <option value="pendente">Pendente</option>
                        <option value="aprovado">Aprovado</option>
                        <option value="arquivado">Arquivado</option>
                    </select>
                </div>

                <div>
                    
                </div>
            </div>
        </div>

        @if(isset($arquivos) && $arquivos->count())
            <div class="row g-4" id="cardsContainer">
                @foreach($arquivos as $arquivo)
                    @php
                        $status = $arquivo->status ?? 'pendente';
                        $prestadorNome = $arquivo->prestador?->nome ?? $arquivo->prestador?->user?->name ?? 'Anónimo';
                    @endphp

                    <div class="col-md-6 col-lg-4 repo-card" 
                         data-title="{{ strtolower($arquivo->titulo ?? '') }}" 
                         data-prestador="{{ strtolower($prestadorNome) }}" 
                         data-status="{{ $status }}">
                        <div class="card card-repo h-100 shadow-sm border-0">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-start justify-content-between mb-3">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="feature-icon lilac">
                                            <i class="bx bx-file" style="font-size:20px"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1" style="line-height:1.05">{{ Str::limit($arquivo->titulo, 70) }}</h5>
                                            <div class="small text-muted">Por <strong class="text-dark">{{ $prestadorNome }}</strong></div>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <span class="badge badge-status 
                                            {{ $status === 'aprovado' ? 'bg-success' : ($status === 'arquivado' ? 'bg-secondary' : 'bg-warning text-dark') }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </div>
                                </div>

                                <p class="text-muted mb-3" style="flex:0 0 auto;">{{ Str::limit($arquivo->descricao ?? '—', 100) }}</p>

                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <div class="file-meta">
                                        <div><i class="bx bx-hash me-1"></i> {{ $humanFilesize($arquivo->size ?? 0) }}</div>
                                        <div class="text-muted small"><i class="bx bx-calendar me-1"></i> {{ $arquivo->created_at?->format('d/m/Y') ?? '—' }}</div>
                                    </div>

                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('arquivos.download', $arquivo) }}">
                                            <i class="bx bx-download"></i>
                                        </a>

                                        <a class="btn btn-sm btn-primary" 
                                        href="{{ route('arquivo2.show', $arquivo->id) }}""   
                                        >      
                                            <i class="bx bx-show me-1"></i> 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 d-flex justify-content-center">
                @if(method_exists($arquivos, 'links'))
                    {{ $arquivos->links('pagination::bootstrap-5') }}
                @endif
            </div>

        @else
            <div class="alert alert-info">
                <strong>Sem arquivos.</strong> Ainda não há conjuntos de dados publicados. Seja o primeiro a <a href="{{ route('repos.submeter') }}">submeter um conjunto de dados</a>.
            </div>
        @endif
    </div>
</section>

<!-- Modal: file preview / metadata -->
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div>
            <h5 class="modal-title" id="fileModalLabel">Detalhe do Arquivo</h5>
            <small class="text-muted" id="fileModalSmall"></small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-8">
                <h5 id="modalTitle" class="mb-2"></h5>
                <p id="modalDesc" class="text-muted"></p>
            </div>
            <div class="col-md-4">
                <ul class="list-unstyled">
                    <li class="mb-2"><strong>Prestador:</strong> <div id="modalPrestador" class="small text-muted"></div></li>
                    <li class="mb-2"><strong>Tamanho:</strong> <div id="modalSize" class="small text-muted"></div></li>
                    <li class="mb-2"><strong>Enviado:</strong> <div id="modalCreated" class="small text-muted"></div></li>
                    <li class="mb-2"><strong>Status:</strong> <div id="modalStatus" class="small text-muted"></div></li>
                </ul>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <a id="modalDownload" class="btn btn-primary" href="#" target="_blank"><i class="bx bx-download me-1"></i> Download</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
    (function(){
        // filtros client-side simples
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const cards = Array.from(document.querySelectorAll('.repo-card'));

        function normalize(s){ return (s||'').toString().trim().toLowerCase(); }

        function applyFilters(){
            const q = normalize(searchInput.value);
            const status = statusFilter.value;
            cards.forEach(card => {
                const title = card.dataset.title || '';
                const prestador = card.dataset.prestador || '';
                const cardStatus = card.dataset.status || '';
                const matchesQ = q === '' || title.includes(q) || prestador.includes(q);
                const matchesStatus = status === 'all' || cardStatus === status;
                card.style.display = (matchesQ && matchesStatus) ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', applyFilters);
        statusFilter.addEventListener('change', applyFilters);

        // modal preenchimento
        const fileModal = document.getElementById('fileModal');
        fileModal.addEventListener('show.bs.modal', function(e){
            const button = e.relatedTarget;
            const title = button.dataset.title || '—';
            const desc = button.dataset.desc || '—';
            const prestador = button.dataset.prestador || '—';
            const size = button.dataset.size || '—';
            const created = button.dataset.created || '—';
            const url = button.dataset.url || '#';
            const status = button.dataset.status || '—';

            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalDesc').innerText = desc;
            document.getElementById('modalPrestador').innerText = prestador;
            document.getElementById('modalSize').innerText = size;
            document.getElementById('modalCreated').innerText = created;
            document.getElementById('modalStatus').innerText = status;
            document.getElementById('fileModalSmall').innerText = `Arquivo — ${title}`;
            document.getElementById('modalDownload').setAttribute('href', url);
        });

        // init
        applyFilters();
    })();
</script>

@endsection
