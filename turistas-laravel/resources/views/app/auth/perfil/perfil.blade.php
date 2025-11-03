@extends('app.dashboard.layouts.app')
@section('title','Perfil')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Configurações da Conta /</span> Perfil</h4>

    <div class="row">
        <div class="col-md-12">
            <!-- Aba de navegação -->
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Perfil</a>
                </li>
            </ul>

            <!-- Card da foto -->
            <div class="card mb-4">
                <h5 class="card-header">Foto de Perfil</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.foto.update') }}" enctype="multipart/form-data" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Salvando...';">
                        @csrf

                        <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @if(Auth::user()->imagem)

                       <a href="{{ asset('storage/'.$user->imagem) }}" target="_blank"><img src="{{ asset('storage/'.$user->imagem) }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" /></a>
                       @else
                       <a href="/dashboard/assets/img/avatars/1.png" target="_blank"><img src="/dashboard/assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" /></a>
                       @endif
                      
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Carregar Nova Foto</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload" name="imagem"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label>
                          <button type="submit" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Atualizar</span>
                          </button>
          

                          <p class="text-muted mb-0">Formatos JPG, GIF or PNG. Tamanho máximo  4M</p>
                        </div>
                      </div>
                    </div>

                        
                    </form>
                                               <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal"  class="btn btn-outline-danger account-image-reset mb-4" >
    <i class="bx bx-trash d-block d-sm-none"></i>
    <span class="d-none d-sm-block">Apagar</span>
</a>
                    
                </div>
            </div>
 
                                            <form action="{{route('profile.foto.eliminar')}}" method="POST" style="display:inline-block;" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Deletando...';">
                                    @csrf
                                    @method('DELETE')

                                    {{-- Delete Modal --}}
                                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Eliminar a foto ?</h5>
                                                    <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Tem a certeza que deseja eliminar a foto de perfil?</p>
                                                       <input
                              type="text"
                               name="imagem"
                               value="{{Auth::user()->imagem}}"
                               hidden
                                       />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Eliminar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
            <!-- Card de informações do usuário -->
            <div class="card mb-4">
                <h5 class="card-header">Informações do Usuário</h5>
                                   @if (session('status') === 'profile-updated')
            <span class="text-success">{{ __('Salvo.') }}</span>
            <!-- Traduzido: Salvo -->
        @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Salvando...';">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required autofocus required
         pattern="^[A-Za-zÀ-ÖØ-öø-ÿÇç0-9][A-Za-zÀ-ÖØ-öø-ÿÇç0-9 ]{2,}$"
         title="O nome deve começar com letra ou número, ter pelo menos 3 caracteres, pode conter acentos e espaços, mas não símbolos especiais."
         maxlength="100">
                               @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                               @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Província</label>
                                <select name="provincia_id" id="provinciaSelect" class="form-select" required>
                                    @foreach($provincias as $provincia)
                                        <option value="{{ $provincia->id }}" {{ $user->municipio->provincia_id == $provincia->id ? 'selected' : '' }}>{{ $provincia->nome }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Município</label>
                                <select name="municipio_id" id="municipioSelect" class="form-select" required>
                                    <option value="{{ $user->municipio->id }}">{{ $user->municipio->nome }}</option>
                                </select>
                                    @error('municipio_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                            </div>

                            @role('prestador')
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Whatsapp</label>
                                <input type="text" id="telefone1" name="telefone1" class="form-control" required value="{{ old('telefone1', $user->prestador->telefone1 ?? '') }}">
                               @error('whatsapp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                            </div>

                             <div class="mb-3 col-md-6">
                                <label class="form-label">Nº Chamada</label>
                                <input type="text" id="telefone2" name="telefone2" class="form-control" required value="{{ old('telefone2', $user->prestador->telefone2 ?? '') }}">
                               @error('whatsapp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                            </div>


                                 <div class="mb-3 col-md-6">
                                <label class="form-label">Bairro</label>
                                <input type="text" name="bairro" class="form-control" required value="{{ old('bairro', $user->prestador->bairro ?? '') }}">
                               @error('bairro')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                            </div>

                       <div class="mb-3 col-12">
    <label class="form-label">Biografia</label>
    <textarea name="biografia" class="form-control" rows="5" style="min-height: 150px;">{{ old('biografia', $user->prestador->biografia ?? '') }}</textarea>
    @error('biografia')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
</div>
@endrole

                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
           
                    </form>
                </div>
            </div>

            <!-- Card de senha -->
            <div class="card mb-4">
                <h5 class="card-header">Redefinir Senha</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Senha Atual</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Nova Senha</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Confirmar Nova Senha</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar Senha</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    document.getElementById('provinciaSelect').addEventListener('change', function() {
        let provinciaId = this.value;
        fetch(`/municipios/${provinciaId}`)
            .then(response => response.json())
            .then(data => {
                let municipioSelect = document.getElementById('municipioSelect');
                municipioSelect.innerHTML = '';
                data.forEach(function(municipio) {
                    municipioSelect.innerHTML += `<option value="${municipio.id}">${municipio.nome}</option>`;
                });
            });
    });
</script>
<script>
    document.getElementById('upload').addEventListener('change', function (event) {
        const input = event.target;
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById('uploadedAvatar').src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    });
</script>



<script>
    document.getElementById('telefone1').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove qualquer caractere que não seja número
        if (value.length > 9) {
            value = value.substring(0, 9); // Limita a 9 caracteres
        }
        e.target.value = value;
    });
    </script>
     <script>
    document.getElementById('telefone2').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove qualquer caractere que não seja número
        if (value.length > 9) {
            value = value.substring(0, 9); // Limita a 9 caracteres
        }
        e.target.value = value;
    });
    </script>
@endsection
