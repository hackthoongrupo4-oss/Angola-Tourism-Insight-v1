@extends('app.dashboard.layouts.app')
@section('title','Meus Serviços')

@section('content')
    <!-- Basic Bootstrap Table -->
           <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Serviços /</span> Meus Serviços</h4>

              <div class="card">
                <h5 class="card-header">Lista</h5>
                <div>
                  
                     <a href="{{route('servicos.create')}}" class="ml-3 btn btn-primary" >
        <i class="bx bx-plus"></i> Adicionar
    </a>
                </div>
        
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Preco</th>
                        <th>SubCat</th>
                        <th>Visivel</th>
                        
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
    @foreach($servicos as $servico)
        <tr 
            @if($servico->marcado)
                class="table-success" {{-- prioridade 1: marcado --}}
            @elseif($servico->destaque)
                class="table-warning" {{-- prioridade 2: destaque --}}
            @endif
        >
            <td>
                <i class="fab fa-angular fa-lg text-danger me-3"></i> 
                <strong>{{ Str::limit($servico->nome, 15, '...') }}</strong>
                @if($servico->marcado)
                    <span class="badge bg-success ms-1">Marcado</span>
                @elseif($servico->destaque)
                    <span class="badge bg-warning ms-1">Destaque</span>
                @endif
            </td>
            <td>{{ $servico->preco ?? 'Negociável' }}</td>
            <td>{{ $servico->subcategoria->nome?? 'Inválida' }}</td>
                 <td>
                                    <span class="badge {{ $servico->visivel ? 'bg-success' : 'bg-danger' }}">
                                        {{ $servico->visivel ? 'Sim' : 'Não' }}
                                    </span>
                                </td>

            <td>
                <a href="{{ route('servicos.detalhes', $servico->slug) }}" class="btn btn-sm btn-primary" title="Ver detalhes">
                    <i class="bx bx-show"></i>
                </a>

                <!-- Botão Eliminar -->
                <a title="Apagar serviço" href="javascript:void(0);" 
                   class="btn btn-sm btn-danger"
                   data-bs-toggle="modal" 
                   data-bs-target="#deleteModal{{ $servico->id }}">
                    <i class="bx bx-trash"></i>
                </a>

                {{-- Delete Form --}}
                <form action="{{ route('servicos.destroy',$servico) }}" method="POST" style="display:inline-block;" 
                      onsubmit="let btn=this.querySelector('button[type=submit]');btn.disabled=true;btn.innerText='Deletando...';">
                    @csrf
                    @method('DELETE')

                    {{-- Delete Modal --}}
                    <div class="modal fade" id="deleteModal{{$servico->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Eliminar Serviço?</h5>
                                    <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Tem a certeza que deseja eliminar o serviço :  "{{ $servico->nome }}"?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Eliminar</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

                  </table>
                  <div class="pagination-container">
                    {{$servicos->links('pagination::bootstrap-5')}}
                  </div>


                  
                </div>
              </div>



                </div>
                  </div>
              <!--/ Basic Bootstrap Table -->
@endsection