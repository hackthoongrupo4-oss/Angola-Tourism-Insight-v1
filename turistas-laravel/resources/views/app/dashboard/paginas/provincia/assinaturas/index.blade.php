 @extends('app.dashboard.layouts.app')

@section('title', 'Minhas Assinaturas')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Assinaturas /</span> Minhas Assinaturas
        </h4>

        <div class="card">
            <h5 class="card-header">Lista de Assinaturas</h5>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Plano</th>
                            <th>Preço (Kz)</th>
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($assinaturas as $assinatura)
                            <tr>
                                <td><strong>{{ $assinatura->plano->nome ?? 'N/A' }}</strong></td>
                                <td>{{ number_format($assinatura->preco, 2, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($assinatura->data_inicio)->format('d/m/Y H:i:s') }}</td>
                                @if($assinatura->data_fim)
                            <td>{{    \Carbon\Carbon::parse($assinatura->data_fim)->endOfDay()->format('d/m/Y H:i:s') }} </td>
                            @else
                            <td>Indefinida</td>
                            @endif
                                   <td>
                                @if($assinatura->status == 'ativa')
                                    <span class="badge bg-success">Ativa</span>
                                @elseif($assinatura->status == 'expirada')
                                    <span class="badge bg-warning text-dark">Expirada</span>
                                @else
                                    <span class="badge bg-danger">Cancelada</span>
                                @endif
                            </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detalhesModal{{ $assinatura->id }}">
                                                <i class="bx bx-show-alt me-1"></i> Ver Detalhes
                                            </a>
                                            @if($assinatura->status === 'ativa')
                                            <form action="" method="">
                                                @csrf
                                                @method('PATCH')
                                                <button class="dropdown-item" type="button">
                                                    <i class="bx bx-x-circle me-1"></i> Cancelar
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal de Detalhes --}}
                            <div class="modal fade" id="detalhesModal{{ $assinatura->id }}" tabindex="-1" aria-labelledby="detalhesModalLabel{{ $assinatura->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detalhesModalLabel{{ $assinatura->id }}">
                                                Detalhes da Assinatura: {{ $assinatura->plano->nome ?? 'N/A' }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Plano:</strong> {{ $assinatura->plano->nome ?? 'N/A' }}</p>
                                            <p><strong>Preço:</strong> {{ number_format($assinatura->preco, 2, ',', '.') }} Kz</p>
                                            <p><strong>Data de Início:</strong> {{ \Carbon\Carbon::parse($assinatura->data_inicio)->format('d/m/Y') }}</p>
                                            <p><strong>Data de Fim:</strong> {{ \Carbon\Carbon::parse($assinatura->data_fim)->format('d/m/Y') }}</p>
                                            <p><strong>Status:</strong> {{ ucfirst($assinatura->status) }}</p>
                                            <p><strong>Plano Slug:</strong> {{ $assinatura->plano->slug ?? 'N/A' }}</p>
                                            <p><strong>Descrição:</strong> {{ $assinatura->plano->descricao ?? 'Sem descrição.' }}</p>
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
                                <td colspan="6" class="text-center">Nenhuma assinatura encontrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination-container">
                    {{$assinaturas->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
