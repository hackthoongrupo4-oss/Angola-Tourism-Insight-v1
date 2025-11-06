@extends('app.dashboard.layouts.app')
@section('title','Publicar Arquivo')
@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Prestador /</span> Publicar Arquivo</h4>

    <div class="card">
      <h5 class="card-header">Novo Arquivo</h5>
      <div class="card-body">
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
          </div>
        @endif

        <form action="{{ route('arquivos.store') }}" method="POST" enctype="multipart/form-data" onsubmit="this.querySelector('button[type=submit]').disabled=true;">
          @csrf
          <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" required maxlength="191">
          </div>

          <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="4" maxlength="4000">{{ old('descricao') }}</textarea>
            <small class="text-muted">Descreva o conjunto de dados: origem, campos, periodicidade, licença.</small>
          </div>

          <div class="mb-3">
            <label class="form-label">Arquivo (CSV, XLSX, DOCX, PDF, ZIP)</label>
            <input type="file" name="arquivo" class="form-control" required accept=".csv,.txt,.xls,.xlsx,.ods,.doc,.docx,.pdf,.zip">
            <small class="text-muted">Máximo 10MB. Tipos permitidos: csv, xls, xlsx, ods, doc, docx, pdf, zip, txt.</small>
          </div>

          <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit">Publicar (Enviar)</button>
            <a href="{{ route('arquivos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection
