@extends('app.dashboard.layouts.app')
@section('title','Detalhe do Arquivo')
@section('content')

@php
    $humanFilesize = function($bytes, $decimals = 2) {
        $size = ['B','KB','MB','GB','TB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        if ($factor == 0) return $bytes . ' ' . $size[0];
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . $size[$factor];
    };

    $arquivoUrl = $arquivo->url();
    $mime = $arquivo->mime ?? '';
    $ext = pathinfo($arquivo->arquivo_path, PATHINFO_EXTENSION);
@endphp


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Prestador /</span> Detalhe do Arquivo</h4>
                <small class="text-muted">Título: <strong>{{ $arquivo->titulo }}</strong></small>
            </div>

            <div class="text-end">
                <a href="{{ route('arquivos.index') }}" class="btn btn-outline-secondary me-2">
                    <i class="bx bx-arrow-back"></i> Voltar
                </a>
                <a href="{{ route('arquivos.download', $arquivo->id) }}" class="btn btn-primary me-2">
    <i class="bx bx-download"></i> Download
</a>


       


               

                @can('delete', $arquivo)
                    <form action="{{ route('arquivos.destroy', $arquivo->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmar eliminação deste arquivo?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"><i class="bx bx-trash"></i> Apagar</button>
                    </form>
                @endcan
            </div>
        </div>

        <div class="row g-3">
            <!-- Left: preview / viewer -->
            <div class="col-lg-8">
                <div class="card shadow-sm rounded-4 mb-3">
                    <div class="card-body p-3">
                        <h5 class="card-title mb-3"><i class="bx bx-file"></i> Pré-visualização</h5>

                        {{-- Decide como mostrar preview --}}
                        <div id="previewArea" class="mb-3" style="min-height:240px;">
                            @if(Str::startsWith($mime, 'image/'))
                                {{-- Imagem --}}
                                <div class="text-center">
                                    <img src="{{ $arquivoUrl }}" alt="{{ $arquivo->titulo }}" class="img-fluid rounded" style="max-height:520px; object-fit:contain;">
                                </div>

                            @elseif($mime === 'application/pdf' || $ext === 'pdf')
                                {{-- PDF embed --}}
                                <div style="min-height:360px;">
                                    <iframe src="{{ $arquivoUrl }}" style="width:100%; height:520px; border:0;" frameborder="0"></iframe>
                                </div>

                            @elseif(Str::startsWith($mime, 'text/') || in_array($ext, ['csv','txt','json','log']))
                                {{-- Texto/CSV: busca e mostra amostra --}}
                                <div id="textPreview" class="bg-light border rounded p-3" style="max-height:520px; overflow:auto;">
                                    <div class="text-muted">Carregando conteúdo...</div>
                                </div>

                            @else
                                {{-- Outros tipos (xlsx, docx, zip...) mostrar info + link --}}
                                <div class="p-4 bg-light rounded">
                                    <p class="mb-1"><strong>Tipo:</strong> {{ $mime ?: strtoupper($ext) }}</p>
                                    <p class="mb-1"><strong>Tamanho:</strong> {{ humanFilesize($arquivo->size ?? 0) }}</p>
                                    <p class="mb-0 text-muted">Pré-visualização não disponível para este tipo de ficheiro. Faça download para visualizar.</p>
                                </div>
                            @endif
                        </div>

                        {{-- Descrição --}}
                        <div class="mt-3">
                            <h6 class="mb-1">Descrição</h6>
                            <div class="p-3 bg-white border rounded" style="white-space:pre-line;">
                                {{ $arquivo->descricao ?? '—' }}
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Histórico de ações / comentários (opcional) --}}
                <div class="card shadow-sm rounded-4">
                    <div class="card-body">
                        <h6 class="mb-3">Informações & Observações</h6>
                        <div class="row">
                            <div class="col-md-6 mb-2"><small class="text-muted">Enviado por</small><div>{{ $arquivo->prestador?->nome ?? $arquivo->prestador?->user?->name ?? '—' }}</div></div>
                            <div class="col-md-6 mb-2"><small class="text-muted">Enviado em</small><div>{{ $arquivo->created_at?->format('d/m/Y H:i') }}</div></div>
                            <div class="col-md-6 mb-2"><small class="text-muted">Status</small>
                                <div>
                                    <span class="badge {{ $arquivo->status === 'aprovado' ? 'bg-success' : ($arquivo->status === 'arquivado' ? 'bg-secondary' : 'bg-warning') }}">
                                        {{ ucfirst($arquivo->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2"><small class="text-muted">Última alteração</small><div>{{ $arquivo->updated_at?->diffForHumans() }}</div></div>

                            @if($arquivo->aprovado_por)
                                <div class="col-12 mt-2"><small class="text-muted">Aprovado por</small><div>{{ $arquivo->aprovadoPor?->name ?? '—' }} em {{ $arquivo->aprovado_em?->format('d/m/Y H:i') }}</div></div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right: meta + ações rápidas -->
            <div class="col-lg-4">
                <div class="card shadow-sm rounded-4 mb-3">
                    <div class="card-body">
                        <h6 class="mb-3">Metadados</h6>

                        <dl class="row">
                            <dt class="col-sm-5 small text-muted">Título</dt><dd class="col-sm-7">{{ $arquivo->titulo }}</dd>
                            <dt class="col-sm-5 small text-muted">Arquivo</dt>
                                <dd class="col-sm-7">        <a href="{{ route('arquivos.download', $arquivo->id) }}" target="_blank" rel="noopener noreferrer">
    {{ basename($arquivo->arquivo_path) }}
</a></dd>
                            <dt class="col-sm-5 small text-muted">Tipo / Mime</dt><dd class="col-sm-7">{{ $mime ?: strtoupper($ext) }}</dd>
                            <dt class="col-sm-5 small text-muted">Tamanho</dt><dd class="col-sm-7">{{ $humanFilesize($arquivo->size ?? 0) }}
</dd>
                            <dt class="col-sm-5 small text-muted">Prestador</dt><dd class="col-sm-7">{{ $arquivo->prestador?->nome ?? $arquivo->prestador?->user?->name ?? '—' }}</dd>
                            <dt class="col-sm-5 small text-muted">Status</dt><dd class="col-sm-7">{{ ucfirst($arquivo->status) }}</dd>
                            <dt class="col-sm-5 small text-muted">Criado em</dt><dd class="col-sm-7">{{ $arquivo->created_at?->format('d/m/Y H:i') }}</dd>
                        </dl>

                        <div class="mt-3 d-grid gap-2">
                            <a href="" class="btn btn-outline-primary btn-sm"><i class="bx bx-download"></i> Download</a>

                            @can('delete', $arquivo)
                                <form action="{{ route('arquivos.destroy', $arquivo->id) }}" method="POST" onsubmit="return confirm('Deseja mesmo apagar este arquivo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="bx bx-trash"></i> Apagar</button>
                                </form>
                            @endcan

                            @role('admin')
                                @if($arquivo->status !== 'aprovado')
                                    <form action="{{ route('arquivos.aprovar', $arquivo->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success btn-sm" type="submit"><i class="bx bx-check"></i> Aprovar</button>
                                    </form>
                                @endif
                                @if($arquivo->status !== 'arquivado')
                                    <form action="{{ route('arquivos.archivar', $arquivo->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="bx bx-archive"></i> Arquivar</button>
                                    </form>
                                @endif
                            @endrole
                        </div>

                    </div>
                </div>

                {{-- Pequeno widget de licença / tags (opcional) --}}
                <div class="card shadow-sm rounded-4">
                    <div class="card-body">
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

{{-- Script: preview para ficheiros de texto (CSV, TXT, JSON) --}}
<script>
    document.addEventListener('DOMContentLoaded', function(){
        const mime = @json($mime);
        const ext = @json($ext);
        const arquivoUrl = @json($arquivoUrl);

        if ((mime && mime.startsWith('text/')) || ['csv','txt','json','log'].includes(ext.toLowerCase())) {
            // fetch small part of file
            fetch(arquivoUrl).then(resp => {
                if(!resp.ok) throw new Error('Não foi possível carregar o ficheiro');
                return resp.text();
            }).then(text => {
                const maxChars = 15000; // limita preview
                const sample = text.length > maxChars ? text.substring(0, maxChars) + "\n\n... (preview limitado)" : text;
                const pre = document.getElementById('textPreview');
                if(pre){
                    pre.innerHTML = '<pre class="small mb-0" style="white-space:pre-wrap;">' + (sample.replace(/</g,'&lt;')) + '</pre>';
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
