@extends('app.dashboard.layouts.app')
@section('title','Sugestões')

@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Definições /</span> Sugestões</h4>

    <div class="card">
      <h5 class="card-header">Lista de Sugestões</h5>

      <div class="mb-3">
        <button type="button" class="ml-3 btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
          <i class="bx bx-plus"></i> Adicionar
        </button>
      </div>

      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach($sugestaos as $sugestao)
            <tr>
              <td><strong>{{ $sugestao->nome }}</strong></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <!-- Editar -->
                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editModal{{ $sugestao->id }}">
                      <i class="bx bx-edit-alt me-1"></i> Editar
                    </a>

                    <!-- Eliminar -->
                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $sugestao->id }}">
                      <i class="bx bx-trash me-1"></i> Eliminar
                    </a>

                    <!-- Itens de Sugestão -->
                    <a class="dropdown-item" href="{{ route('itens_sugestao.index', $sugestao->id) }}">
                      <i class="bx bx-list-ul me-1"></i> Itens
                    </a>
                  </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $sugestao->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $sugestao->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Editar Sugestão</h5>
                        <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="{{ route('sugestaos.update', $sugestao->id) }}" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Salvando...';">
                          @method('PUT')
                          @csrf
                          <div class="mb-3">
                            <label for="nome{{ $sugestao->id }}" class="form-label">Nome da Sugestão</label>
                            <input type="text" class="form-control" id="nome{{ $sugestao->id }}" name="nome" value="{{ $sugestao->nome }}" required maxlength="150">
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Editar</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Delete Modal -->
                <form action="{{ route('sugestaos.destroy', $sugestao->id) }}" method="POST" style="display:inline-block;" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Eliminando...';">
                  @csrf
                  @method('DELETE')
                  <div class="modal fade" id="deleteModal{{ $sugestao->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Eliminar Sugestão</h5>
                          <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>Tens certeza que desejas eliminar a sugestão <strong>"{{ $sugestao->nome }}"</strong>?</p>
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
            @endforeach
          </tbody>
        </table>

        <div class="pagination-container">
          {{ $sugestaos->links('pagination::bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>

  <!-- Create Modal -->
  <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Adicionar Sugestão</h5>
          <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ route('sugestaos.store') }}" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Salvando...';">
            @csrf
            <div class="mb-3">
              <label for="nome" class="form-label">Nome da Sugestão</label>
              <input type="text" class="form-control" id="nome" name="nome" required maxlength="150">
            </div>
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
@endsection
