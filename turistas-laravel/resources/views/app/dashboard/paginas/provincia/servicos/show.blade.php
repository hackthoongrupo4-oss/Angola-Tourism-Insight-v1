 @extends('app.dashboard.layouts.app')
@section('title','Serviço : '.$servico->nome)
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Serviço /</span> Editar</h4>

    <div class="row">
        <div class="col-md-12">

            <!-- Formulário de Atualização das Informações -->
            <div class="card mb-4">
               <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Informações do Serviço</h5>
               
                @if($destacado)
               <div class="alert alert-danger">
                    Serviço já tem um destaque ativo 
               </div>
              
                @else
                  <a href="#" data-bs-toggle="modal" data-bs-target="#destacar" class="btn btn-danger text-white">Destacar Serviço</a>
                 @endif
                 
                
            </div>
                 <div class="card-header d-flex justify-content-between align-items-center">
                 
                    @if($servico->marcado)
                    <span class="badge bg-success ms-1">Marcado</span>
                @elseif($servico->destaque)
                    <span class="badge bg-warning ms-1">Destaque</span>
                @endif

                <span class="badge {{ $servico->visivel ? 'bg-success' : 'bg-danger' }}">
                                    Visivel ?     {{ $servico->visivel ? 'Sim' : 'Não' }}
                                    
                                
                                </span>
                                
                               
               
                
            </div>

            <div class="card-header d-flex justify-content-between align-items-center">
                 @if(!$servico->visivel)
                                    Serviços Não visiveis, ficam indisponiveis na página inicial, por irregularidade
                                @endif
            </div>
            
            <div class="card-header d-flex justify-content-between align-items-center">
  <a href="#" data-bs-toggle="modal" data-bs-target="#infoPlano" class="btn btn-primary text-white">Info plano</a>
  </div>              
  <form method="POST" action="{{ route('servicos.update', $servico) }}" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Salvando...';">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nome do serviço</label>
                                <input type="text" name="nome" class="form-control" value="{{ old('nome', $servico->nome) }}" required
         pattern="^[A-Za-zÀ-ÖØ-öø-ÿÇç0-9][A-Za-zÀ-ÖØ-öø-ÿÇç0-9 ]{2,}$"
         title="O nome deve começar com letra ou número, ter pelo menos 3 caracteres, pode conter acentos e espaços, mas não símbolos especiais."
         maxlength="100">
                            </div>

                                               <div class="mb-3 col-md-6">
    <label class="form-label d-block">Preço</label>

    <div class="form-check form-switch mb-2">
        <input class="form-check-input" type="checkbox" id="preco_negociavel" name="preco_negociavel" value="{{!($servico->preco)?'1':'0'}}"  {{!($servico->preco)?'checked':''}}>
        <label class="form-check-label" for="preco_negociavel">Preço Negociável</label>
    </div>

    <input type="number" step="0.01" class="form-control" name="preco" value="{{($servico->preco)?$servico->preco:''}}" min="0"   id="campo_preco" placeholder="Digite o preço">
</div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Categoria</label>
                                <select name="categoria_id" id="categoria" class="form-select" required>
                                    <option value="">Seleciona a Categoria</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ $servico->categoria_id == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">SubCategoria</label>
                                <select name="subcategoria_id" id="subcategoria" class="form-select" required>
                                    <option value="">Seleciona a SubCategoria</option>
                                    @foreach($subcategorias as $sub)
                                        <option value="{{ $sub->id }}" {{ $servico->subcategoria_id == $sub->id ? 'selected' : '' }}>
                                            {{ $sub->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label">Descrição</label>
                                <textarea name="descricao" class="form-control" rows="5">{{ old('descricao', $servico->descricao) }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>

            <!-- Fotos do Serviço -->
            <div class="card mb-4">
                <h5 class="card-header">Fotos do Serviço</h5>
                <div class="card-body">
                    <div class="row">
                        @foreach($servico->imagens as $imagem)
                            <div class="col-md-2 text-center mb-3">
                                <a href="{{ asset('storage/' . $imagem->imagem) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $imagem->imagem) }}" class="img-fluid rounded mb-2" style="height: 80px; width: 120px; object-fit: cover;">
                                </a>
                                 <button type="button"  class="btn btn-sm btn-danger"  data-bs-toggle="modal"  data-bs-target="#deleteModal{{ $imagem->id }}">Eliminar</button>
                                @php
                                    $imagem2=explode("/",$imagem->imagem)[1];
                                @endphp
                                 <form action="{{ route('imagens.eliminar',$imagem2) }}" method="POST" style="display:inline-block;" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Deletando...';">
                                    @csrf
                                    @method('DELETE')

                                    {{-- Delete Modal --}}
                                    <div class="modal fade" id="deleteModal{{$imagem->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Eliminar Imagem?</h5>
                                                    <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Tem a certeza que deseja eliminar  essa imagem ? </p>
                                                    <input type="text" name="imagem" value="{{$imagem->imagem}}" hidden>
                                                      <input type="text" name="servico" value="{{$servico->slug}}" hidden>
                                                                                                                                                            
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Eliminar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @php
             $n_imagens_permitidas=$n_imagens-$servico->imagens()->count();

            @endphp
            <!-- Formulário Separado para Adicionar Novas Fotos -->
            <div class="card mb-4">
                <h5 class="card-header">Adicionar Novas Fotos, {{$n_imagens_permitidas>0?$n_imagens_permitidas:0}} Permitida (s)</h5>
               @if($n_imagens_permitidas <1)
                <div class="alert alert-danger">
                    Para Atualizar o numero de imagens, deves eliminar imagens já existentes para estar dentro do número de imagens permitdas pelo plano
                </div>
                @endif
                <form method="POST" action="{{route('imagens.inserir')}}" enctype="multipart/form-data" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Salvando...';">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            @for ($i = 0; $i < $n_imagens_permitidas; $i++)
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Foto {{ $i + 1 }}</label>
                                    <input type="file" name="fotos[]" class="form-control" accept="image/*">
                                </div>
                            @endfor
                            <input type="text" name="servico_id" value="{{$servico->id}}" hidden>
                        </div>
                        @if($n_imagens_permitidas>0)
                        <button type="submit" class="btn btn-success">Adicionar Fotos</button>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
 













<!-- Edit Modal -->
 <div class="modal fade" id="infoPlano" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white">Informações do Plano e Destaques</h5>
                <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{-- 🔷 INFORMAÇÕES DA ASSINATURA --}}
                <h6 class="text-primary">📅 Assinatura Atual</h6>
                <ul>
                    <li><strong>Data de Início do plano:</strong> {{\Carbon\Carbon::parse($assinatura->data_inicio) ->format('d/m/Y H:i') }}</li>
                    <li><strong>Status:</strong> {{ ucfirst($assinatura->status) }}</li>
                    <li>
                        <strong>Data de Fim do plano:</strong>
                        {{ $assinatura->data_fim ? \Carbon\Carbon::parse( $assinatura->data_fim)->endOfDay() : 'Plano Gratuito (Sem fim)' }}
                    </li>
                </ul>

                <hr>

                {{-- 🔷 INFORMAÇÕES DO PLANO --}}
                <h6 class="text-success">📦 Plano Ativo: {{ $assinatura->plano->nome }}</h6>
                <ul>
                    <li><strong>Preço:</strong> {{ number_format($assinatura->plano->preco, 2, ',', '.') }} Kz</li>
                    <li><strong>Limite de Serviços:</strong> {{ $assinatura->plano->limite_servicos }}</li>
                    <li><strong>Limite de Imagens por Serviço:</strong> {{ $assinatura->plano->limite_imagens }}</li>
                    <li><strong>Limite de Destaques por plano:</strong> {{ $assinatura->plano->limite_destaque ?? '---' }}</li>
                </ul>

                @if($assinatura->plano->tipoDestaque)
                    <hr>

                    {{-- 🔷 INFORMAÇÕES DO TIPO DE DESTAQUE ASSOCIADO AO PLANO --}}
                    <h6 class="text-warning">✨ Tipo de Destaque Incluso no Plano</h6>
                    <ul>
                        <li><strong>Nome:</strong> {{ $assinatura->plano->tipoDestaque->nome }}</li>
                        <li><strong>Duração:</strong> {{ $assinatura->plano->tipoDestaque->duracao_dias }} dias</li>
                        <li><strong>Mostrar na Home?</strong> {{ $assinatura->plano->tipoDestaque->mostrar_home ? 'Sim' : 'Não' }}</li>
                        <li><strong>Topo da Categoria?</strong> {{ $assinatura->plano->tipoDestaque->topo_categoria ? 'Sim' : 'Não' }}</li>
                        <li><strong>Ícone de Destaque?</strong> {{ $assinatura->plano->tipoDestaque->icone_destaque ? 'Sim' : 'Não' }}</li>
                       
                    </ul>
                @endif

                @if($destaque_ativo!=null)
                    <hr>

                    {{-- 🔷 INFORMAÇÕES DO DESTAQUE ATUAL DO SERVIÇO --}}
                    <h6 class="text-danger">🔥 Destaque Ativo no Serviço</h6>
                    <ul>
                        <li><strong>Tipo de Destaque:</strong> {{ $destaque_ativo->tipoDestaque->nome }}</li>
                        <li><strong>Forma:</strong> {{ ucfirst($destaque_ativo->forma) }}</li>
                        <li><strong>Data de Início:</strong> {{  \Carbon\Carbon::parse($destaque_ativo->data_inicio)->format('d/m/Y H:i') }}</li>
                        <li><strong>Data de Fim:</strong> {{\Carbon\Carbon::parse( $destaque_ativo->data_fim)->endOfDay()->format('d/m/Y H:i') }}</li>
                        <li><strong>Status:</strong> {{ $destaque_ativo->ativo ? 'Ativo' : 'Inativo' }}</li>
                    </ul>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>








<!-- Edit Modal -->
<div class="modal fade" id="destacar" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="{{ route('servicos.destacar') }}" id="formDestacar" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Destacando...';">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Destacar Serviço</h5>
                    <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
    Número de destaques usados : <strong>{{ $n_destaques }}</strong><br>
    Limite permitido pelo plano: <strong>{{ $assinatura->plano->limite_destaque }}</strong>
 
 
</p>

@if($n_destaques >= $assinatura->plano->limite_destaque)
    <div class="alert alert-warning">
        ⚠️ Você atingiu o limite de destaques permitido pelo seu plano.
    </div>
@endif

 @if( $assinatura->plano->tipoDestaque &&       $assinatura->plano->tipoDestaque->duracao_dias>$resultado['dias'])

  <div class="alert alert-warning">
        ⚠️ O número de dias faltando para o plano terminar, não satisfazem o permitido pelo tipo de destaque
    </div>

        @endif

{{-- Opção 1: Pelo plano --}}
<div class="form-check">
    <input class="form-check-input"
           type="radio"
           name="tipo_destaque"
           id="plano"
           value="plano"
           
           {{ ($assinatura->plano->tipoDestaque && $n_destaques < $assinatura->plano->limite_destaque && $assinatura->plano->tipoDestaque->duracao_dias<=$resultado['dias']) ? 'checked' : 'disabled' }}>
    <label class="form-check-label text-muted" for="plano">
        Destacar pelo Plano
        @if($assinatura->plano->tipoDestaque &&    $n_destaques >= $assinatura->plano->limite_destaque)
            <span class="text-danger">(limite atingido)</span>
        @endif

                @if(  $assinatura->plano->tipoDestaque &&       $assinatura->plano->tipoDestaque->duracao_dias>$resultado['dias'])
            <span class="text-danger">(Dias restantes insuficiente)</span>
        @endif

                        @if(  !$assinatura->plano->tipoDestaque )
            <span class="text-danger">(Nenhum Destaque no plano)</span>
        @endif

    </label>
</div>
                    <input type="hidden" name="plano_id" value="{{ $assinatura->plano_id }}">
                    <input type="hidden" name="servico_id" value="{{ $servico->id }}">


{{-- Opção 2: Código --}}
<div class="form-check mt-2">
    <input class="form-check-input"
           type="radio"
           name="tipo_destaque"
           id="codigo"
           value="codigo"
           {{ $n_destaques >= $assinatura->plano->limite_destaque ? 'checked' : '' }}>
    <label class="form-check-label" for="codigo">
        Destacar com Código
    </label>
</div>

{{-- Select de tipo de destaque --}}
<div class="mt-3 d-none" id="campoTipoDestaque">
    <label class="form-label">Tipo de Destaque</label>
    <select name="tipo_destaque_id" id="tipo_destaque_id" class="form-select">
        <option value="" disabled selected>-- Selecione o tipo --</option>
        @foreach($tipos_destaque as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->nome }} ({{ $tipo->duracao_dias }} dias)-- {{number_format($tipo->preco,2,',','.')}} kz</option>
        @endforeach
    </select>
</div>

{{-- Campo do código --}}
<div class="mt-3 d-none" id="campoCodigo">
    <label class="form-label" for="codigo_input">Código de Destaque</label>
    <input type="text" name="codigo_destacar" id="codigo_input" class="form-control">
</div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Destacar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                </div>




            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const radioPlano = document.getElementById("plano");
        const radioCodigo = document.getElementById("codigo");
        const campoTipoDestaque = document.getElementById("campoTipoDestaque");
        const campoCodigo = document.getElementById("campoCodigo");
        const selectTipo = document.getElementById("tipo_destaque_id");
        const inputCodigo = document.getElementById("codigo_input");

        function resetCampos() {
            campoTipoDestaque.classList.add("d-none");
            campoCodigo.classList.add("d-none");

            selectTipo.removeAttribute("required");
            selectTipo.value = "";
            inputCodigo.removeAttribute("required");
            inputCodigo.value = "";
        }

        function handleChange() {
            if (radioCodigo.checked) {
                campoTipoDestaque.classList.remove("d-none");
                selectTipo.setAttribute("required", "required");

                // Verifica se já tem valor selecionado para mostrar o campo do código
                if (selectTipo.value) {
                    campoCodigo.classList.remove("d-none");
                    inputCodigo.setAttribute("required", "required");
                }
            } else {
                resetCampos();
            }
        }

        selectTipo.addEventListener("change", function () {
            if (selectTipo.value) {
                campoCodigo.classList.remove("d-none");
                inputCodigo.setAttribute("required", "required");
            } else {
                campoCodigo.classList.add("d-none");
                inputCodigo.removeAttribute("required");
            }
        });

        radioPlano.addEventListener("change", handleChange);
        radioCodigo.addEventListener("change", handleChange);

        // ✅ Corrige o problema: executa no carregamento da página
        handleChange();
    });
</script>


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
            campoPreco.value={{$servico->preco}}
            campoPreco.closest('.mb-3').querySelector('label.form-label').classList.remove('text-muted');
        }
    }

    precoNegociavelCheckbox.addEventListener('change', toggleCampoPreco);

    // Executa uma vez ao carregar a página
    toggleCampoPreco();
</script>
@endsection
