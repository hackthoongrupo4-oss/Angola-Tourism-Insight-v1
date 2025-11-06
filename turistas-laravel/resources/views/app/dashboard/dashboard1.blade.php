@extends('app.dashboard.layouts.app')


 @section('title','Painel')

@section('content')

<div class="container-fluid py-4">

   
 

    <h3 class="my-4">Administrador</h3>
    <div class="row g-4">
     
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-secondary" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-person fs-1 mb-2"></i>
                    <h4 class="card-title">{{$n_prev}} </h4>
                    <p class="card-text">Nº Previsões</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-success" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-person-check fs-1 mb-2"></i>
                    <h4 class="card-title">{{$n_prov}} </h4>
                    <p class="card-text">Provincias</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-warning" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-file-text fs-1 mb-2"></i>
                    <h4 class="card-title"> {{$n_users}}</h4>
                    <p class="card-text">Usuarios</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-primary" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-file-earmark fs-1 mb-2"></i>
                    <h4 class="card-title"> {{$n_sugestao}} </h4>
                    <p class="card-text">Tipos de padrões</p>
                </div>
            </div>
        </div>

               <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-primary" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-file-earmark fs-1 mb-2"></i>
                    <h4 class="card-title"> {{$n_item}} </h4>
                    <p class="card-text">Nº de sugestões</p>
                </div>
            </div>
        </div>
               



               


    </div>


    <h3 class="my-4">Repositorios</h3>
    <div class="row g-4">
     
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-secondary" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-person fs-1 mb-2"></i>
                    <h4 class="card-title">{{$n_a}} </h4>
                    <p class="card-text">Nº arquivos</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-success" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-person-check fs-1 mb-2"></i>
                    <h4 class="card-title">{{$n_a_ap}} </h4>
                    <p class="card-text">Nº arquivos aprovados</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-warning" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-file-text fs-1 mb-2"></i>
                    <h4 class="card-title"> {{$n_a_p}}</h4>
                    <p class="card-text">Nº arquivos pendentes</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-primary" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-file-earmark fs-1 mb-2"></i>
                    <h4 class="card-title"> {{$n_a_n}} </h4>
                    <p class="card-text">Nº arquivos negados</p>
                </div>
            </div>
        </div>

               <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-primary" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-file-earmark fs-1 mb-2"></i>
                    <h4 class="card-title"> {{$n_prest}} </h4>
                    <p class="card-text">Nº de prestadores</p>
                </div>
            </div>
        </div>
               



               


    </div>


</div>

@endsection
