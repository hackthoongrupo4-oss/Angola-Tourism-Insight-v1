@extends('app.dashboard.layouts.app')
@section('title','Minhas Assinaturas')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Planos /</span> Assinaturas</h4>

        @if(isset($resultado))
            <div class="alert alert-success">Plano Ativado Com Sucesso</div>
        @endif

        <div class="card">
            <h5 class="card-header">Lista de Assinaturas</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Prestador</th>
                            <th>Plano</th>
                            <th>Preço</th>
                            <th>Data Início</th>
                            <th>Data Fim</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($assinaturas as $assinatura)
                        <tr>
                            <td>{{ $assinatura->prestador->usuario->name ?? '—' }}</td>
                            <td>{{ $assinatura->plano->nome ?? '—' }}</td>
                            <td>{{ number_format($assinatura->preco, 2, ',', '.') }} KZ</td>
                            <td>{{ \Carbon\Carbon::parse($assinatura->data_inicio)->format('d/m/Y H:i:s') }}</td>
                            @if($assinatura->data_fim)
                            <td>{{    \Carbon\Carbon::parse($assinatura->data_fim)->format('d/m/Y') }} </td>
                            @else
                            <td>Indefinida</td>
                            @endif
                            <td>
                                @if($assinatura->status == 'ativa')
                                    <span class="badge bg-success">Ativa</span>
                                @elseif($assinatura->status == 'expirada')
                                    <span class="badge bg-warning text-dark">Expirada</span>
                                @else
                                    <span class="badge bg-danger">Cancelada</span>
                                @endif
                            </td>
                            <td>
                                <!-- Aqui pode adicionar botões de ação -->
                                <a href="#" class="btn btn-sm btn-outline-primary">Ver</a>
                                @if($assinatura->status == 'ativa')
                                <form action="" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja cancelar esta assinatura?')">
                                        Cancelar
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
    if(perfomance.navigation===1){
        window.location.href="{{route('assinaturas.minha')}}"
    }
</script>
@endsection
