@extends('app.dashboard.layouts.app')
@section('title','Meus Arquivos')
@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Prestador /</span> Meus Arquivos</h4>

    <div class="card">
      <h5 class="card-header">Lista</h5>
      <div class="card-body">

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
          <a href="{{ route('arquivos.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Novo Arquivo</a>
        </div>

        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Arquivo</th>
                <th>Status</th>
                <th>Enviado em</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @forelse($arquivos as $a)
                <tr>
                  <td>{{ Str::limit($a->titulo, 40) }}</td>
                  <td>{{ Str::limit($a->descricao, 80) }}</td>
                  <td>
                           <a href="{{ route('arquivos.download', $a->id) }}" class="btn btn-primary me-2">
    <i class="bx bx-download"></i> Download
</a>
                  </td>
                  <td>
                    <span class="badge {{ $a->status === 'aprovado' ? 'bg-success' : ($a->status === 'arquivado' ? 'bg-secondary' : 'bg-warning') }}">
                      {{ ucfirst($a->status) }}
                    </span>
                  </td>
                  <td>{{ $a->created_at->format('d/m/Y H:i') }}</td>
                  <td>
                    <div class="d-flex gap-2">
                      <a href="{{ route('arquivos.show', $a->id) }}" class="btn btn-sm btn-outline-info"><i class="bx bx-show"></i></a>

                      <form action="{{ route('arquivos.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Confirmar eliminação?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit"><i class="bx bx-trash"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center">Nenhum arquivo encontrado.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="mt-3">
          {{ $arquivos->links('pagination::bootstrap-5') }}
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
