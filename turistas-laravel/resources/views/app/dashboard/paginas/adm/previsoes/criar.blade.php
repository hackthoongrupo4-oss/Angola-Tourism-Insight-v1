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

            {{-- Feriado --}}
            <div class="col-md-3">
              <label for="feriado" class="form-label">Feriado?</label>
              <select id="feriado" name="feriado" class="form-select" required>
                <option value="0" {{ old('feriado') === '0' ? 'selected' : '' }}>Não</option>
                <option value="1" {{ old('feriado') === '1' ? 'selected' : '' }}>Sim</option>
              </select>
            </div>

           

 

{{-- Localidades --}}
<div class="col-md-12 mt-3">
    <label class="form-label">Localidade</label><br>
    <div class="form-check form-check-inline">
        <input class="form-check-input localidade-checkbox" type="checkbox" id="localidade_Benguela" name="localidade_Benguela" value="1" {{ old('localidade_Benguela') ? 'checked' : '' }}>
        <label class="form-check-label" for="localidade_Benguela">Benguela</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input localidade-checkbox" type="checkbox" id="localidade_Luanda" name="localidade_Luanda" value="1" {{ old('localidade_Luanda',1) ? 'checked' : '' }}>
        <label class="form-check-label" for="localidade_Luanda">Luanda</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input localidade-checkbox" type="checkbox" id="localidade_Lubango" name="localidade_Lubango" value="1" {{ old('localidade_Lubango') ? 'checked' : '' }}>
        <label class="form-check-label" for="localidade_Lubango">Lubango</label>
    </div>
</div>

<script>
document.querySelectorAll('.localidade-checkbox').forEach(function(checkbox){
    checkbox.addEventListener('change', function(){
        if(this.checked){
            // desmarca os outros checkboxes
            document.querySelectorAll('.localidade-checkbox').forEach(function(cb){
                if(cb !== checkbox) cb.checked = false;
            });
        }
    });
});
</script>




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

@endsection
