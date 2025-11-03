 @extends('app.dashboard.layouts.app')
@section('title','Provincias')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Definições /</span> Províncias</h4>

        <div class="card">
            <h5 class="card-header">Lista</h5>

            <div class="mx-3 my-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bx bx-plus"></i> Adicionar
                </button>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome2</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($provincias as $provincia)
                            <tr>
                                <td><strong>{{ $provincia->nome }}</strong></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"
                                               data-bs-toggle="modal" data-bs-target="#editModal{{ $provincia->id }}">
                                                <i class="bx bx-edit-alt me-1"></i> Editar
                                            </a>
                                            @role('admin')
                                               <a class="dropdown-item" href="javascript:void(0);"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $provincia->id }}" ><i class="bx bx-trash me-1"></i> Eliminar</a>
                                            
                                            @endrole

                                <a class="dropdown-item" href="{{route('municipios.index2',$provincia->slug)}}"
                             
                              ><i class="bx bx-edit-alt me-1"></i> Usuarios</a
                              >
                                        </div>
                                    </div>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $provincia->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $provincia->id }}" aria-hidden="true" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Editar Província</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ route('provincias.update', $provincia->id) }}" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Salvando...';">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label class="form-label">Nome</label>
                                                            <input type="text" class="form-control" name="nome"
                                                                value="{{ $provincia->nome }}"  required
         pattern="^[A-Za-zÀ-ÖØ-öø-ÿÇç0-9][A-Za-zÀ-ÖØ-öø-ÿÇç0-9 ]{2,}$"
         title="A provincia deve começar com letra ou número, ter pelo menos 3 caracteres, pode conter acentos e espaços, mas não símbolos especiais."
         maxlength="100">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <form method="POST" action="{{ route('provincias.destroy', $provincia->id) }}" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Deletando...';">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal fade" id="deleteModal{{ $provincia->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Eliminar Província?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Deseja realmente eliminar a província "{{ $provincia->nome }}"?</p>
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

                <div class="pagination-container m-3">
                    {{ $provincias->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Província</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('provincias.store') }}" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Salvando...';">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" name="nome" required
         pattern="^[A-Za-zÀ-ÖØ-öø-ÿÇç0-9][A-Za-zÀ-ÖØ-öø-ÿÇç0-9 ]{2,}$"
         title="A provincia deve começar com letra ou número, ter pelo menos 3 caracteres, pode conter acentos e espaços, mas não símbolos especiais."
         maxlength="100">
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
