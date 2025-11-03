@extends('app.dashboard.layouts.app')

@section('title', 'Meus Destaques')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Destaques /</span> Meus Destaques
        </h4>

        <div class="card">
            <h5 class="card-header">Lista de Destaques</h5>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Serviço</th>
                            <th>Tipo de Destaque</th>
                            <th>Forma</th>
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($destaques as $destaque)
                            <tr>
                              
                                <td><strong>{{ Str::limit($destaque->servico->nome ?? 'N/A',15,'...')  }}</strong></td>
                                <td>{{ $destaque->tipoDestaque->nome ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-info">{{ ucfirst($destaque->forma) }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($destaque->data_inicio)->format('d/m/Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($destaque->data_fim)->endOfDay()->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if($destaque->ativo)
                                        <span class="badge bg-success">Ativo</span>
                                    @else
                                        <span class="badge bg-danger">Inativo</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detalhesModal{{ $destaque->id }}">
                                                <i class="bx bx-show-alt me-1"></i> Ver Detalhes
                                            </a>
                                         
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal de Detalhes --}}
                            <div class="modal fade" id="detalhesModal{{ $destaque->id }}" tabindex="-1" aria-labelledby="detalhesModalLabel{{ $destaque->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detalhesModalLabel{{ $destaque->id }}">
                                                Detalhes do Destaque - {{ $destaque->servico->nome ?? 'N/A' }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Serviço:</strong> {{ $destaque->servico->nome ?? 'N/A' }}</p>
                                            <p><strong>Prestador:</strong> {{ $destaque->prestador->nome ?? 'N/A' }}</p>
                                            <p><strong>Tipo de Destaque:</strong> {{ $destaque->tipoDestaque->nome ?? 'N/A' }}</p>
                                            <p><strong>Preço:</strong> {{ number_format($destaque->tipoDestaque->preco ?? 0, 2, ',', '.') }} Kz</p>
                                            <p><strong>Duração:</strong> {{ $destaque->tipoDestaque->duracao_dias ?? '-' }} dias</p>
                                            <p><strong>Forma:</strong> {{ ucfirst($destaque->forma) }}</p>
                                            <p><strong>Data de Início:</strong> {{ \Carbon\Carbon::parse($destaque->data_inicio)->format('d/m/Y H:i') }}</p>
                                            <p><strong>Data de Fim:</strong> {{ \Carbon\Carbon::parse($destaque->data_fim)->endOfDay()->format('d/m/Y H:i') }}</p>
                                            <p><strong>Status:</strong> {{ $destaque->ativo ? 'Ativo' : 'Inativo' }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Fim Modal --}}
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Nenhum destaque encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination-container">
                    {{ $destaques->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
