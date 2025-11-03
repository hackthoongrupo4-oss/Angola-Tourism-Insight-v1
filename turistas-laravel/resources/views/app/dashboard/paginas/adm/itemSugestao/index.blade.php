@extends('app.dashboard.layouts.app')

@section('title','Itens de Sugestão')
@section('content')
    <!-- Basic Bootstrap Table -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Definições /</span> Itens de Sugestão - {{ $sugestao->nome }}
            </h4>

            <div class="card">
                <h5 class="card-header">Lista de itens da sugestão "{{ $sugestao->nome }}"</h5>

                <div class="mb-3">
                    <a href="{{ route('sugestaos.index') }}" class="btn btn-secondary"><i class="bx bx-arrow-back"></i> Voltar</a>
                    <button type="button" class="ml-3 btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bx bx-plus"></i> Adicionar Item
                    </button>
                </div>

                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse($itens as $item)
                                <tr>
                                    <td><strong>{{ Str::limit($item->descricao, 120) }}</strong></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <!-- Editar -->
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Editar
                                                </a>

                                                <!-- Eliminar -->
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                                    <i class="bx bx-trash me-1"></i> Eliminar
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog  modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Editar Item</h5>
                                                        <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('itens_sugestao.update', $item->id) }}" id="formItemEdit{{ $item->id }}" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Salvando...';">
                                                            @method('PUT')
                                                            @csrf

                                                            <div class="mb-3">
                                                                <label for="descricao{{ $item->id }}" class="form-label">Descrição</label>
                                                                <textarea class="form-control" id="descricao{{ $item->id }}" name="descricao" rows="4" required maxlength="2000">{{ $item->descricao }}</textarea>
                                                            </div>

                                                            <input type="hidden" name="sugestao_id" value="{{ $sugestao->id }}">

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Editar</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Form + Modal -->
                                        <form action="{{ route('itens_sugestao.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Deletando...';">
                                            @csrf
                                            @method('DELETE')

                                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Eliminar Item?</h5>
                                                            <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Tem a certeza que deseja eliminar este item?</p>
                                                            <p><small class="text-muted">{{ Str::limit($item->descricao, 200) }}</small></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Eliminar</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">Nenhum item encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="pagination-container">
                        {{ $itens->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

            <!-- Create Modal -->
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Adicionar Item à sugestão "{{ $sugestao->nome }}"</h5>
                            <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('itens_sugestao.store') }}" id="formItemCreate" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Salvando...';">
                                @csrf

                                <div class="mb-3">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <textarea class="form-control" id="descricao" name="descricao" rows="4" required maxlength="2000" placeholder="Descreva a sugestão..."></textarea>
                                </div>

                                <input type="hidden" name="sugestao_id" value="{{ $sugestao->id }}">

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Adicionar</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection
