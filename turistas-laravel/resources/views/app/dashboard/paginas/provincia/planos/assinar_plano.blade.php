@extends('app.dashboard.layouts.app')
@section('title','Assinar plano')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        
        <!-- Cabeçalho com o nome do plano -->
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Assinar Plano /</span> {{ $plano->nome }}
        </h4>

        <!-- Mensagem de sucesso ou erro -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Card com o formulário -->
        <div class="card">
            <h5 class="card-header">Digite o Código da Assinatura</h5>
            <div class="card-body">
                <form action="{{ route('plano.assinar', $plano->slug) }}" method="POST" onsubmit="this.querySelector('button').disabled=true;">
                    @csrf
                    <div class="mb-3">
                        <label for="codigo" class="form-label">Código de Assinatura</label>
                        <input type="text" name="codigo" id="codigo" class="form-control" required placeholder="Insira o código fornecido">
                     <input type="text" name="plano_id" value="{{$plano->id}}" hidden> 
                        @error('codigo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Assinar Plano</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
