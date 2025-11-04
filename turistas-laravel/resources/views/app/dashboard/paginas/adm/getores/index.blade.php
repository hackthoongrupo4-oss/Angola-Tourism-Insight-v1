@extends('app.dashboard.layouts.app')
@section('title','Usuários')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Definições / Províncias /</span> Usuários - {{ $provincia->nome }}
        </h4>

        <div class="card">
            <h5 class="card-header">Lista de Usuários - {{ $provincia->nome }}</h5>

            <div class="mx-3 my-2">
                <a href="{{ route('provincias.index') }}" class="btn btn-secondary"><i class="bx bx-arrow-back"></i> Voltar</a>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                    <i class="bx bx-plus"></i> Adicionar Usuário
                </button>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Data criação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($users as $user)
                            <tr>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <!-- Editar (abre modal) -->
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                                <i class="bx bx-edit-alt me-1"></i> Editar
                                            </a>

                                            <!-- Eliminar (só para admin, se estiveres a usar spatie/roles) -->
                                            @role('admin')
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}">
                                                <i class="bx bx-trash me-1"></i> Eliminar
                                            </a>
                                            @endrole
                                        </div>
                                    </div>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Editar Usuário</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('users.update', $user->id) }}" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Salvando...';">
                                                        @method('PUT')
                                                        @csrf

                                                        <!-- Nome -->
                                                        <div class="mb-3">
                                                            <label for="name{{ $user->id }}" class="form-label">Nome Completo</label>
                                                            <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ old('name', $user->name) }}" minlength="4" required pattern="^[^\s].{3,}$" title="O nome deve ter pelo menos 4 caracteres e não pode começar com espaço.">
                                                        </div>

                                                        <!-- Email -->
                                                        <div class="mb-3">
                                                            <label for="email{{ $user->id }}" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ old('email', $user->email) }}" required>
                                                        </div>

                                                        <!-- Password (opcional) -->
                                                        <div class="mb-3">
                                                            <label for="password{{ $user->id }}" class="form-label">Password (deixe vazio para manter)</label>
                                                            <input type="password" id="password{{ $user->id }}" name="password" class="form-control" placeholder="Nova password (opcional)">
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

                                    <!-- Delete Modal + Form -->
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline-block;" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Eliminando...';">
                                        @csrf
                                        @method('DELETE')

                                        <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Eliminar Usuário?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Deseja realmente eliminar o usuário <strong>{{ $user->name }}</strong> ({{ $user->email }})?</p>
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
                                <td colspan="4" class="text-center">Nenhum usuário encontrado nesta província.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="pagination-container m-3">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal (formulário de registro fornecido) -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('register') }}" method="POST" onsubmit="this.querySelector('button').disabled=true;">
                        @csrf

                        <!-- Nome Completo -->
                        <div class="mb-3 container-email">
                            <label for="name" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Digite o seu nome completo"  minlength="4" required
         pattern="^[^\s].{3,}$"
         title="O nome deve ter pelo menos 4 caracteres e não pode começar com espaço.">
                            @if($errors->has('name'))
                                <div class="text-danger mt-1">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <!-- Email -->
                        <div class="mb-3 container-email">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Digite o seu melhor email" required>
                            @if($errors->has('email'))
                                <div class="text-danger mt-1">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <!-- Senha -->
                        <div class="mb-3 container-password">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Digite a tua password" required>
                            @if($errors->has('password'))
                                <div class="text-danger mt-1">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <!-- Confirmar Senha -->
                        <div class="mb-3 container-password">
                            <label for="password_confirmation" class="form-label">Confirmar Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirme a tua password" required>
                            @if($errors->has('password_confirmation'))
                                <div class="text-danger mt-1">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>

                        <!-- Se quiseres associar automaticamente o user à província (gestor), podes mandar hidden: -->
                        <input type="hidden" name="provincia_id" value="{{ $provincia->id }}">

                        <!-- Botão de Registro -->
                        <div class="container-login-button">
                            <button class="btn btn-secondary w-100" type="submit">Registrar</button>

                            <div class="mt-2 text-center">
                                <span class="link-secondary text-decoration-none">Já tem uma conta?</span>
                                <a href="{{ route('login') }}" class="link-secondary"> Entrar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // evita múltiplos submits no create modal (apenas UX extra)
    document.querySelectorAll('#createUserModal form, .modal form').forEach(form=>{
        form.addEventListener('submit', function(){
            const btn = this.querySelector('button[type=submit]');
            if(btn) btn.disabled = true;
        });
    });
</script>
@endpush

@endsection
