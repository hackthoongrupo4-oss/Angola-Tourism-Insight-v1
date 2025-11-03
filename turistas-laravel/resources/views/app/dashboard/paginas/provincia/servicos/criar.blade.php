@extends('app.dashboard.layouts.app')
@section('title','Criar Serviço')
@section('content')
@php
      // Define aqui o número máximo de fotos
    $maxServicos=$planoAtual->limite_servicos- $n_servicos;
    $pode =($maxServicos>0)?true:false;
@endphp

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold  mb-1"><span class="text-muted fw-light">Plano atual /</span> {{$plano->nome}}</h4>
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Serviço /</span> Criar</h4>

    <div class="row">
        <div class="col-md-12">
            <!-- Aba de navegação -->
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Criar Serviço</a>
                </li>
            </ul>
  
            @if($plano->ilimitado==true)    
            <div class="alert alert-danger">Número de serviços ilimitado </div>
            @else
            <div class="alert alert-danger">Restam {{ $maxServicos <=0?0:$maxServicos}} Serviço(s) por cadastrar no seu plano </div>                 
            @endif
            <!-- Card de informações do serviço -->
            <div class="card mb-4">
                <h5 class="card-header">Informações do Serviço</h5>
                  @if($pode || ($plano->ilimitado==true))
                <form method="POST" action="{{route('servicos.store')}}" enctype="multipart/form-data" 
      onsubmit="let btn=document.getElementById('btnSalvar');btn.disabled=true;btn.innerText='Salvando...';">

                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nome do serviço</label>
                                <input type="text" class="form-control" name="nome" required autofocus minlength="3" required
         pattern="^[A-Za-zÀ-ÖØ-öø-ÿÇç0-9][A-Za-zÀ-ÖØ-öø-ÿÇç0-9 ]{2,}$"
         title="O nome deve começar com letra ou número, ter pelo menos 3 caracteres, pode conter acentos e espaços, mas não símbolos especiais."
         maxlength="100">
                            </div>

                           <div class="mb-3 col-md-6">
    <label class="form-label d-block">Preço</label>

    <div class="form-check form-switch mb-2">
        <input class="form-check-input" type="checkbox" id="preco_negociavel" name="preco_negociavel" value="1">
        <label class="form-check-label" for="preco_negociavel">Preço Negociável</label>
    </div>

    <input type="number" step="0.01" class="form-control" name="preco" id="campo_preco" min="0" placeholder="Digite o preço">
</div>


                            <div class="mb-3 col-md-6">
                                <label class="form-label">Categoria</label>
                                <select name="categoria_id" id="categoria" class="form-select" required>
                                    <option value="" selected disabled>Seleciona a Categoria</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">SubCategoria</label>
                                <select class="form-select" id="subcategoria" name="subcategoria_id" required>
                                    <option value="" selected disabled>Seleciona a SubCategoria</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label">Descrição</label>
                                <textarea name="descricao" class="form-control" rows="5" style="min-height: 150px;"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
 
   
            <!-- Card de Fotos -->
            <div class="card mb-4">
                <h5 class="card-header">Carregar Fotos do Serviço (Máx. {{ $plano->limite_imagens }})</h5>
                <div class="card-body">
                    <div class="row">
                        @for ($i = 1; $i <= $plano->limite_imagens; $i++)
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Foto {{ $i }}</label>
                                <input type="file" name="fotos[]" class="form-control" accept="image/png, image/jpeg">
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
         
            <button type="submit" id="btnSalvar" class="btn btn-primary">Salvar Serviço</button>
          
            </form>
              @endif
        </div>
    </div>
</div>

<script>
    document.getElementById('categoria').addEventListener('change', function () {
        const categoriaId = this.value;

        fetch(`/subcategorias/buscar/${categoriaId}`)
            .then(response => response.json())
            .then(data => {
                let subcategoriaSelect = document.getElementById('subcategoria');
                subcategoriaSelect.innerHTML = '<option selected disabled>Seleciona a subcategoria</option>';
                data.forEach(subcategoria => {
                    let option = document.createElement('option');
                    option.value = subcategoria.id;
                    option.text = subcategoria.nome;
                    subcategoriaSelect.appendChild(option);
                });
            });
    });
</script>
<script>
    const precoNegociavelCheckbox = document.getElementById('preco_negociavel');
    const campoPreco = document.getElementById('campo_preco');

    function toggleCampoPreco() {
        if (precoNegociavelCheckbox.checked) {
            campoPreco.value = '';
            campoPreco.disabled = true;
            campoPreco.closest('.mb-3').querySelector('label.form-label').classList.add('text-muted');
        } else {
            campoPreco.disabled = false;
            campoPreco.closest('.mb-3').querySelector('label.form-label').classList.remove('text-muted');
        }
    }

    precoNegociavelCheckbox.addEventListener('change', toggleCampoPreco);

    // Executa uma vez ao carregar a página
    toggleCampoPreco();
</script>

@endsection
