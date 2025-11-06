@extends('app.dashboard.layouts.app')
@section('title','Criar Previsão')
@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Previsões /</span> Nova Previsão</h4>

    <div class="card">
      <h5 class="card-header">Formulário de Previsão</h5>
      <div class="card-body">
        {{-- Mensagens de validação --}}
        @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('previsoes2.store') }}" method="POST" id="formPrevisao" onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='A processar...';">
          @csrf

          <div class="row g-3">
            {{-- Data (date) --}}
            <div class="col-md-4">
              <label for="data" class="form-label">Data</label>
              <input type="date" id="data" name="data" class="form-control" value="{{ old('data') }}" required>
            </div>

            {{-- Ano --}}
            <div class="col-md-2">
              <label for="ano" class="form-label">Ano</label>
              <input type="number" id="ano" name="ano" class="form-control" value="{{ old('ano', now()->year) }}" min="1900" max="2100" required>
            </div>

            {{-- Mês --}}
            <div class="col-md-2">
              <label for="mes" class="form-label">Mês</label>
              <select id="mes" name="mes" class="form-select" required>
                @php
                  $meses = [
                    1=>'Janeiro',2=>'Fevereiro',3=>'Março',4=>'Abril',5=>'Maio',6=>'Junho',
                    7=>'Julho',8=>'Agosto',9=>'Setembro',10=>'Outubro',11=>'Novembro',12=>'Dezembro'
                  ];
                @endphp
                <option value="" disabled {{ old('mes') ? '' : 'selected' }}>Seleciona o mês</option>
                @foreach($meses as $k=>$m)
                  <option value="{{ $k }}" {{ (string)old('mes') === (string)$k ? 'selected' : '' }}>{{ $m }}</option>
                @endforeach
              </select>
            </div>

          <!-- localidade -->
                <div class="col-md-3">
                  <label for="localidade" class="form-label">Localidade <span class="text-danger">*</span></label>
                  <input list="listaLocalidades" id="localidade" name="localidade" class="form-control" value="{{ old('localidade') }}" placeholder="Ex: Luanda, Benguela" required>
                  <datalist id="listaLocalidades">
                    {{-- Opcionalmente preenche com províncias/municípios passados do controller --}}
                    @isset($provincias)
                      @foreach($provincias as $prov)
                        <option value="{{ $prov->nome }}"></option>
                      @endforeach
                    @endisset
                  </datalist>
                </div>

            {{-- Precipitação --}}
            <div class="col-md-4">
              <label for="precipitacao" class="form-label">Precipitação (mm)</label>
              <input type="number" step="0.01" id="precipitacao" name="precipitacao" class="form-control" value="{{ old('precipitacao') }}" required>
            </div>

            {{-- Precipitação média histórica --}}
            <div class="col-md-4">
              <label for="precipitacao_media_historica" class="form-label">Precipitação média histórica (mm)</label>
              <input type="number" step="0.01" id="precipitacao_media_historica" name="precipitacao_media_historica" class="form-control" value="{{ old('precipitacao_media_historica') }}" required>
            </div>

            {{-- Temperatura média --}}
            <div class="col-md-3">
              <label for="temperatura_media" class="form-label">Temperatura média (°C)</label>
              <input type="number" step="0.01" id="temperatura_media" name="temperatura_media" class="form-control" value="{{ old('temperatura_media') }}" required>
            </div>

            {{-- Temperatura média histórica --}}
            <div class="col-md-3">
              <label for="temperatura_media_historica" class="form-label">Temperatura média histórica (°C)</label>
              <input type="number" step="0.01" id="temperatura_media_historica" name="temperatura_media_historica" class="form-control" value="{{ old('temperatura_media_historica') }}" required>
            </div>

            {{-- Temp máxima --}}
            <div class="col-md-3">
              <label for="temp_maxima" class="form-label">Temp. máxima (°C)</label>
              <input type="number" step="0.01" id="temp_maxima" name="temp_maxima" class="form-control" value="{{ old('temp_maxima') }}" required>
            </div>

            {{-- Temp mínima --}}
            <div class="col-md-3">
              <label for="temp_minima" class="form-label">Temp. mínima (°C)</label>
              <input type="number" step="0.01" id="temp_minima" name="temp_minima" class="form-control" value="{{ old('temp_minima') }}" required>
            </div>

            {{-- Temp máxima histórica --}}
            <div class="col-md-3">
              <label for="temp_maxima_historica" class="form-label">Temp. máxima histórica (°C)</label>
              <input type="number" step="0.01" id="temp_maxima_historica" name="temp_maxima_historica" class="form-control" value="{{ old('temp_maxima_historica') }}" required>
            </div>

            {{-- Temp mínima histórica --}}
            <div class="col-md-3">
              <label for="temp_minima_historica" class="form-label">Temp. mínima histórica (°C)</label>
              <input type="number" step="0.01" id="temp_minima_historica" name="temp_minima_historica" class="form-control" value="{{ old('temp_minima_historica') }}" required>
            </div>

            {{-- Feriado (Sim/Não) --}}
            <div class="col-md-3">
              <label for="feriado" class="form-label">Feriado?</label>
              <select id="feriado" name="feriado" class="form-select" required>
                <option value="0" {{ old('feriado') === '0' ? 'selected' : '' }}>Não</option>
                <option value="1" {{ old('feriado') === '1' ? 'selected' : '' }}>Sim</option>
              </select>
            </div>

            {{-- Nome do feriado (aparece só se feriado=Sim) --}}
            <div class="col-md-5" id="feriado_nome_container" style="display: none;">
              <label for="nome_feriado" class="form-label">Nome do Feriado</label>
              <select id="nome_feriado" name="nome_feriado" class="form-select">
                <option value="" disabled {{ old('nome_feriado') ? '' : 'selected' }}>Seleciona o feriado</option>
                @php
                  $feriados = [
                    'Ano Novo',
                    'Início da Luta Armada',
                    'Dia Internacional da Mulher',
                    'Dia da Paz e Reconciliação Nacional',
                    'Dia do Trabalhador',
                    'Dia do Herói Nacional',
                    'Independência Nacional',
                    'Natal e da Família'
                  ];
                @endphp
                @foreach($feriados as $f)
                  <option value="{{ $f }}" {{ old('nome_feriado') === $f ? 'selected' : '' }}>{{ $f }}</option>
                @endforeach
              </select>
            </div>

          
          </div>

          <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Gerar Previsão</button>
            <a href="{{ route('previsoes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>

{{-- Scripts --}}

<script>
  (function(){
    const dataEl = document.getElementById('data');
    const anoEl = document.getElementById('ano');
    const mesEl = document.getElementById('mes');

    const feriadoEl = document.getElementById('feriado');
    const feriadoContainer = document.getElementById('feriado_nome_container');

    // mostra/oculta nome do feriado consoante a opção
    function toggleFeriado() {
      if(feriadoEl.value === '1') {
        feriadoContainer.style.display = '';
        document.getElementById('nome_feriado').setAttribute('required','required');
      } else {
        feriadoContainer.style.display = 'none';
        document.getElementById('nome_feriado').removeAttribute('required');
      }
    }
    feriadoEl.addEventListener('change', toggleFeriado);
    // inicialização (caso old() tenha definido feriado=1)
    if('{{ old("feriado") }}' === '1') {
      feriadoEl.value = '1';
      toggleFeriado();
    }

    // ao escolher a data, preencher ano e mês automaticamente
    if(dataEl){
      dataEl.addEventListener('change', function(){
        if(!this.value) return;
        const d = new Date(this.value);
        anoEl.value = d.getFullYear();
        mesEl.value = d.getMonth() + 1; // mês em 1..12
      });
    }

    // se houver old('data') -> preencher ano/mes ao carregar
    document.addEventListener('DOMContentLoaded', function(){
      // marcar feriado se veio do servidor
      toggleFeriado();
      const dataVal = '{{ old("data") }}';
      if(dataVal){
        try{
          const d = new Date(dataVal);
          if(!isNaN(d)){
            anoEl.value = d.getFullYear();
            mesEl.value = d.getMonth() + 1;
          }
        }catch(e){}
      }
    });
  })();
</script>
 
@endsection
