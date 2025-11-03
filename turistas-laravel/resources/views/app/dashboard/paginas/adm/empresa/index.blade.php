 @extends('app.dashboard.layouts.app')
@section('title','Empresa')
@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Definições /</span> Empresa</h4>

    <div class="card">
      <h5 class="card-header">Informações da Empresa</h5>
      <div class="card-body">

        @if($empresa)
          <form method="POST" action="{{ route('empresas.update', $empresa->id) }}" enctype="multipart/form-data" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Salvando...';">
            @csrf
            @method('PUT')
            
            <div class="row">
              <div class="mb-3 col-md-6">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" value="{{ $empresa->nome }}" required
         pattern="^[A-Za-zÀ-ÖØ-öø-ÿÇç0-9][A-Za-zÀ-ÖØ-öø-ÿÇç0-9 ]{2,}$"
         title="O nome deve começar com letra ou número, ter pelo menos 3 caracteres, pode conter acentos e espaços, mas não símbolos especiais."
         maxlength="100">
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $empresa->email }}" required>
              </div>

              <div class="mb-3 col-md-12">
                <label class="form-label">Endereço</label>
                <input type="text" class="form-control" name="endereco" value="{{ $empresa->endereco }}">
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label">Telefone 1</label>
                <input type="text" class="form-control" name="telefone1" value="{{ $empresa->telefone1 }}">
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label">Telefone 2</label>
                <input type="text" class="form-control" name="telefone2" value="{{ $empresa->telefone2 }}">
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label">Logo Dimensão :119x50</label>
                <input type="file" class="form-control" name="logo"  accept="image/png, image/jpeg">
                @if($empresa->logo)
                  <small class="text-muted">Atual: <a href="{{ asset('storage/' . $empresa->logo) }}" target="_blank">Ver logo</a></small>
                @endif
              </div>
                <label class="form-label">Imagem 4 é a imagem padrão de serviços</label>
              @for($i = 1; $i <= 4; $i++)
              <div class="mb-3 col-md-4">

                <label class="form-label">Imagem {{ $i }} Dimensão :870x431</label>
                <input type="file" class="form-control" name="imagem{{ $i }}"  accept="image/png, image/jpeg">
                @php
                    $campo = 'imagem' . $i;
                @endphp
                @if($empresa->$campo)
                  <small class="text-muted">Atual: <a href="{{ asset('storage/' . $empresa->$campo) }}" target="_blank">Ver imagem</a></small>
                @endif
              </div>
              @endfor
            </div>

            <div class="mt-3">
              <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
          </form>

        @else
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEmpresaModal">
            <i class="bx bx-plus"></i> Adicionar Empresa
          </button>
        @endif

      </div>
    </div>
  </div>
</div>

<!-- Modal de Criação -->
<div class="modal fade" id="createEmpresaModal" tabindex="-1" aria-labelledby="createEmpresaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adicionar Empresa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('empresas.store') }}" enctype="multipart/form-data" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Salvando...';">
          @csrf

          <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">Nome</label>
              <input type="text" class="form-control" name="nome"       required
         pattern="^[A-Za-zÀ-ÖØ-öø-ÿÇç0-9][A-Za-zÀ-ÖØ-öø-ÿÇç0-9 ]{2,}$"
         title="O nome deve começar com letra ou número, ter pelo menos 3 caracteres, pode conter acentos e espaços, mas não símbolos especiais."
         maxlength="100">
            </div>

            <div class="mb-3 col-md-6">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3 col-md-12">
              <label class="form-label">Endereço</label>
              <input type="text" class="form-control" name="endereco">
            </div>

            <div class="mb-3 col-md-6">
  <label class="form-label">Telefone 1</label>
  <input type="text" class="form-control" name="telefone1"
         pattern="^[0-9]{9}$"
         maxlength="9"
         title="O telefone deve ter exatamente 9 dígitos numéricos">
</div>

<div class="mb-3 col-md-6">
  <label class="form-label">Telefone 2</label>
  <input type="text" class="form-control" name="telefone2"
         pattern="^[0-9]{9}$"
         maxlength="9"
         title="O telefone deve ter exatamente 9 dígitos numéricos">
</div>

            <div class="mb-3 col-md-6">
              <label class="form-label">Logo</label>
              <input type="file" class="form-control" name="logo"  accept="image/png, image/jpeg">
            </div>

            @for($i = 1; $i <= 4; $i++)
            <div class="mb-3 col-md-4">
              <label class="form-label">Imagem {{ $i }}</label>
              <input type="file" class="form-control" name="imagem{{ $i }}"  accept="image/png, image/jpeg">
            </div>
            @endfor
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
