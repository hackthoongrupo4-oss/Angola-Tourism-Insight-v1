@extends('app.dashboard.layouts.app')
@section('title','Histórico de Previsões')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- Título com Província --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold py-3 mb-0">
                    <span class="text-muted fw-light">Previsões /</span> Histórico
                </h4>
                @if(isset($provincia))
                    <h6 class="mt-1 text-muted">Província: <strong class="text-primary">{{ $provincia->nome }}</strong></h6>
                @endif
            </div>

            <div>
                <a href="{{ route('previsoes.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus"></i> Nova Previsão
                </a>
            </div>
        </div>

        {{-- Card da tabela --}}
        <div class="card">
            <h5 class="card-header">Lista de Histórico</h5>

            <div class="table-responsive text-nowrap">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Data criação</th>
                            <th>Tipo Padrãoo</th>
                            <th>N.º Turistas</th>
                            <th>Usuário</th>
                            <th>Província</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($historicos as $historico)
                            <tr>
                                <td>{{ $historico->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <strong>{{ $historico->nome_sugestao }}</strong>
                                </td>
                                <td>{{ number_format($historico->n_turistas, 0, ',', '.') }}</td>
                                <td>{{ $historico->user?->name ?? 'Sistema' }}</td>
                                <td>{{ $historico->provincia?->nome ?? ($provincia->nome ?? '—') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        
                                         <a class="btn btn-sm btn-outline-primary" href="{{route('previsoes2.show',$historico->id)}}"  title="Ver detalhes">
                                            <i class="bx bx-show"></i> Ver
                                        </a>
                                        <!-- Ver detalhes (modal) -->
                                       

                                        <!-- Download JSON (opcional) -->
                                        <a href="javascript:void(0);" class="btn btn-sm btn-outline-secondary" onclick="downloadHistorico({{ $historico->id }})" title="Descarregar JSON">
                                            <i class="bx bx-download"></i> JSON
                                        </a>

                                        <!-- Eliminar (só para admin) -->
                                        @role('admin')
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $historico->id }}" title="Eliminar">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        @endrole
                                    </div>
                                </td>
                            </tr>

                            {{-- VIEW MODAL --}}
                            <div class="modal fade" id="viewModal{{ $historico->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $historico->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detalhes da Previsão — {{ $historico->created_at->format('d/m/Y H:i') }}</h5>
                                            <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>N.º Turistas</strong></label>
                                                        <div class="p-3 bg-light rounded">{{ number_format($historico->n_turistas, 0, ',', '.') }}</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Tipo Padrão</strong></label>
                                                        <div class="p-3 bg-light rounded">{{ $historico->nome_sugestao }}</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Usuário</strong></label>
                                                        <div class="p-3 bg-light rounded">{{ $historico->user?->name ?? 'Sistema' }}</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Província</strong></label>
                                                        <div class="p-3 bg-light rounded">{{ $historico->provincia?->nome ?? ($provincia->nome ?? '—') }}</div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label class="form-label"><strong>Parâmetros enviados (data)</strong></label>
                                                    <div class="p-3 bg-white border rounded" style="max-height:360px; overflow:auto;">
                                                        {{-- mostra JSON formatado --}}
                                                        <pre class="small mb-0">{{ json_encode($historico->data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-2">
                                                    <label class="form-label"><strong>Itens de sugestão (tipos_sugestoes)</strong></label>
                                                    <div class="row g-3 mt-1">
                                                        @if(!empty($historico->tipos_sugestoes) && is_array($historico->tipos_sugestoes))
                                                            @foreach($historico->tipos_sugestoes as $idx => $texto)
                                                                <div class="col-md-6">
                                                                    <div class="card h-100 shadow-sm">
                                                                        <div class="card-body">
                                                                            <h6 class="mb-2">Sugestão {{ $idx + 1 }}</h6>
                                                                            <p class="mb-0">{{ $texto }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="col-12">
                                                                <div class="alert alert-secondary mb-0">Sem sugestões gravadas.</div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- DELETE MODAL (se admin) --}}
                            
                         <form action="{{ route('previsoes2.destroy', $historico->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')

    <div class="modal fade" id="deleteModal{{ $historico->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $historico->id }}" aria-hidden="true">
        <!-- modal-dialog-scrollable permite rolar o body; modal-lg dá mais largura em ecrãs maiores -->
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Histórico?</h5>
                    <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <!-- modal-body com classes responsivas e utilitárias para quebra de texto -->
                <div class="modal-body">
                    <p class="mb-0 text-center text-md-start fs-6 fs-md-5 text-muted text-break" style="line-height:1.5;">
                        Tem a certeza que deseja eliminar o histórico registado em
                        <strong class="text-dark">{{ $historico->created_at->format('d/m/Y H:i') }}</strong>
                        (Sugestão:
                        <strong class="text-primary">{{ $historico->nome_sugestao }}</strong>)?
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</form>

                            

                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Nenhum histórico encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginação --}}
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div>
                    @if($historicos instanceof \Illuminate\Pagination\Paginator || $historicos instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        Mostrando {{ $historicos->firstItem() ?? 0 }} - {{ $historicos->lastItem() ?? 0 }} de {{ $historicos->total() }}
                    @endif
                </div>
                <div>
                    {{ $historicos->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Script para descarregar JSON do histórico --}}
<script>
    function downloadHistorico(id){
        // cria um fetch para endpoint que devolve JSON (podes criar rota: historicos.download)
        // fallback: abre modal view e copia o conteúdo; aqui tentamos abrir nova janela com rota /historicos/{id}/download
        const url = `/historicos/${id}/download`;
        window.open(url, '_blank');
    }
</script>
@endsection
