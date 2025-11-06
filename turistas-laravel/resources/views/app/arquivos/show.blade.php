 @extends('app.ap.app')
@section('title','Detalhe do Arquivo')
@section('content')

@php
    // Closure local para formatar tamanho de ficheiros (evita redeclare)
    $humanFilesize = function($bytes, $decimals = 2) {
        $bytes = (int) ($bytes ?? 0);
        if ($bytes === 0) return '0 B';
        $units = ['B','KB','MB','GB','TB'];
        $factor = floor((strlen((string)$bytes) - 1) / 3);
        if ($factor < 0) $factor = 0;
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . $units[$factor];
    };

    $arquivoUrl = $arquivo->url();
    $mime = $arquivo->mime ?? '';
    $ext = strtolower(pathinfo($arquivo->arquivo_path ?? '', PATHINFO_EXTENSION));
@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
  /* White page background and card polish */
  .page-bg { background: #ffffff; }
  .top-header { padding: 1.25rem 0; border-bottom: 1px solid #eef0fb; }
  .page-title { font-weight:700; color:#1f1540; }
  .muted-small { color:#7b7696; font-size:.95rem; }

  .preview-card { border-radius:12px; overflow:hidden; }
  .meta-card { border-radius:12px; }
  .rounded-xxl { border-radius:18px; }

  .badge-status { font-weight:600; text-transform:capitalize; padding:.5rem .6rem; border-radius:.6rem; }
  .download-btn { background: linear-gradient(90deg,#7f6df2,#6b5de0); border:none; color:#fff; }
  .download-btn:hover { filter:brightness(.98); }

  .file-preview-iframe { height:520px; border:0; width:100%; }
  pre.small { font-size:.85rem; white-space:pre-wrap; word-break:break-word; }

  dt { color:#6f6a8a; font-size:.86rem; }
  dd { margin-left:0; font-weight:600; color:#211b45; }

  @media (max-width: 991px) {
    .file-preview-iframe { height:360px; }
  }
</style>

<div class="page-bg">
  <div class="container-xxl py-4">

    <!-- header / breadcrumb -->
    <div class="top-header d-flex align-items-center justify-content-between">
      <div>
        <nav aria-label="breadcrumb" class="mb-1">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="">Repositório</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalhe do Arquivo</li>
          </ol>
        </nav>
        <h2 class="page-title mb-0">{{ $arquivo->titulo }}</h2>
        <div class="muted-small">Enviado por <strong>{{ $arquivo->prestador?->nome ?? $arquivo->prestador?->user?->name ?? '—' }}</strong></div>
      </div>

      <div class="text-end">
        <a href="{{ route('arquivos.download', $arquivo) }}" class="btn download-btn me-2">
          <i class="bx bx-download me-1"></i> Download
        </a>

        @can('delete', $arquivo)
          <!-- trigger modal -->
          <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
            <i class="bx bx-trash me-1"></i> Apagar
          </button>
        @endcan
      </div>
    </div>

    <div class="row g-4 mt-3">
      <!-- left: preview -->
      <div class="col-lg-8">
        <div class="card preview-card shadow-sm rounded-xxl">
          <div class="card-body p-4">
            <h5 class="mb-3"><i class="bx bx-file me-2"></i> Pré-visualização</h5>

            <div id="previewArea" style="min-height:260px;">
              @if($arquivo->arquivo_path && (Str::startsWith($mime, 'image/') || in_array($ext, ['png','jpg','jpeg','gif','webp'])))
                <div class="text-center">
                  <img src="{{ $arquivoUrl }}" alt="{{ $arquivo->titulo }}" class="img-fluid rounded" style="max-height:520px; object-fit:contain;">
                </div>

              @elseif($mime === 'application/pdf' || $ext === 'pdf')
                <div style="min-height:360px;">
                  <iframe class="file-preview-iframe" src="{{ $arquivoUrl }}"></iframe>
                </div>

              @elseif(Str::startsWith($mime, 'text/') || in_array($ext, ['csv','txt','json','log']))
                <div id="textPreview" class="bg-light border rounded p-3" style="max-height:520px; overflow:auto;">
                  <div class="text-muted">Carregando conteúdo...</div>
                </div>

              @else
                <div class="p-4 bg-light rounded">
                  <p class="mb-1"><strong>Tipo:</strong> {{ $mime ?: strtoupper($ext ?: 'Desconhecido') }}</p>
                  <p class="mb-1"><strong>Tamanho:</strong> {{ $humanFilesize($arquivo->size ?? 0) }}</p>
                  <p class="mb-0 text-muted">Pré-visualização não disponível para este tipo de ficheiro. Faça download para visualizar.</p>
                </div>
              @endif
            </div>

            {{-- Descrição --}}
            <div class="mt-4">
              <h6 class="mb-2">Descrição</h6>
              <div class="p-3 bg-white border rounded" style="white-space:pre-line;">
                {{ $arquivo->descricao ?? '—' }}
              </div>
            </div>
          </div>
        </div>

        <!-- info / timeline -->
        <div class="card mt-3 shadow-sm rounded-xxl">
          <div class="card-body p-4">
            <h6 class="mb-3">Informações & Observações</h6>
            <div class="row">
              <div class="col-md-6 mb-3">
                <small class="text-muted">Enviado por</small>
                <div class="fw-semibold">{{ $arquivo->prestador?->nome ?? $arquivo->prestador?->user?->name ?? '—' }}</div>
              </div>

              <div class="col-md-6 mb-3">
                <small class="text-muted">Enviado em</small>
                <div class="fw-semibold">{{ $arquivo->created_at?->format('d/m/Y H:i') ?? '—' }}</div>
              </div>

              <div class="col-md-6 mb-3">
                <small class="text-muted">Status</small>
                <div>
                  <span class="badge badge-status {{ $arquivo->status === 'aprovado' ? 'bg-success' : ($arquivo->status === 'arquivado' ? 'bg-secondary' : 'bg-warning text-dark') }}">
                    {{ ucfirst($arquivo->status ?? 'pendente') }}
                  </span>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <small class="text-muted">Última alteração</small>
                <div class="fw-semibold">{{ $arquivo->updated_at?->diffForHumans() ?? '—' }}</div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- right: metadados -->
      <div class="col-lg-4">
        <div class="card meta-card shadow-sm rounded-xxl p-3">
          <div class="card-body">
            <h6 class="mb-3">Metadados</h6>

            <dl class="row mb-0">
              <dt class="col-sm-5">Título</dt>
              <dd class="col-sm-7">{{ $arquivo->titulo }}</dd>

              <dt class="col-sm-5">Arquivo</dt>
              <dd class="col-sm-7">
                @if($arquivo->arquivo_path)
                  <a href="{{ route('arquivos.download', $arquivo) }}" target="_blank" rel="noopener noreferrer">{{ basename($arquivo->arquivo_path) }}</a>
                @else
                  —
                @endif
              </dd>

              <dt class="col-sm-5">Tipo</dt><dd class="col-sm-7">{{ $mime ?: strtoupper($ext ?: '—') }}</dd>
              <dt class="col-sm-5">Tamanho</dt><dd class="col-sm-7">{{ $humanFilesize($arquivo->size ?? 0) }}</dd>
              <dt class="col-sm-5">Prestador</dt><dd class="col-sm-7">{{ $arquivo->prestador?->nome ?? $arquivo->prestador?->user?->name ?? '—' }}</dd>
              <dt class="col-sm-5">Status</dt><dd class="col-sm-7">{{ ucfirst($arquivo->status ?? 'pendente') }}</dd>
              <dt class="col-sm-5">Criado em</dt><dd class="col-sm-7">{{ $arquivo->created_at?->format('d/m/Y H:i') }}</dd>
            </dl>

            <div class="mt-4 d-grid gap-2">
              <a href="{{ route('arquivos.download', $arquivo) }}" class="btn download-btn btn-sm"><i class="bx bx-download me-1"></i> Download</a>

              @can('delete', $arquivo)
                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                  <i class="bx bx-trash me-1"></i> Apagar
                </button>
              @endcan
            </div>
          </div>
        </div>

        {{-- Licença / Tags --}}
        <div class="card mt-3 shadow-sm rounded-xxl">
          <div class="card-body p-3">
            <h6 class="mb-2">Licença & Tags</h6>
            <p class="small text-muted mb-1">Licença</p>
            <p class="mb-2">{{ $arquivo->licenca ?? 'Não especificada' }}</p>

            <p class="small text-muted mb-1">Tags</p>
            @if(!empty($arquivo->tags))
              @foreach($arquivo->tags as $tag)
                <span class="badge bg-light text-dark me-1">#{{ $tag }}</span>
              @endforeach
            @else
              <div class="text-muted small">Sem tags</div>
            @endif
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Delete confirmation modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('arquivos.destroy', $arquivo->id) }}" method="POST" onsubmit="this.querySelector('button[type=submit]').disabled=true;">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title">Confirmar eliminação</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <p>Tem a certeza que deseja eliminar o ficheiro <strong>{{ $arquivo->titulo }}</strong>?</p>
          <p class="text-muted small">Esta ação é irreversível e removerá também o ficheiro do armazenamento público.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Apagar definitivamente</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Script: preview para ficheiros de texto (CSV, TXT, JSON) --}}
<script>
  document.addEventListener('DOMContentLoaded', function(){
    const mime = @json($mime);
    const ext = @json($ext);
    const arquivoUrl = @json($arquivoUrl);

    if ((mime && mime.startsWith('text/')) || ['csv','txt','json','log'].includes(ext)) {
      fetch(arquivoUrl).then(resp => {
        if(!resp.ok) throw new Error('Não foi possível carregar o ficheiro');
        return resp.text();
      }).then(text => {
        const maxChars = 15000;
        const sample = text.length > maxChars ? text.substring(0, maxChars) + "\n\n... (preview limitado)" : text;
        const pre = document.getElementById('textPreview');
        if(pre){
          pre.innerHTML = '<pre class="small mb-0">' + (sample.replace(/</g,'&lt;')) + '</pre>';
        }
      }).catch(err => {
        const pre = document.getElementById('textPreview');
        if(pre) pre.innerHTML = '<div class="text-danger small">Não foi possível carregar o conteúdo para preview.</div>';
        console.error(err);
      });
    }
  });
</script>

@endsection
