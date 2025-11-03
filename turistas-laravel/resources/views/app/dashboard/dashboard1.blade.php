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
                    <h4 class="card-title"> </h4>
                    <p class="card-text">Usuarios</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-success" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-person-check fs-1 mb-2"></i>
                    <h4 class="card-title"> </h4>
                    <p class="card-text">Prestadores</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-warning" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-file-text fs-1 mb-2"></i>
                    <h4 class="card-title"> </h4>
                    <p class="card-text">Planos</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-primary" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-file-earmark fs-1 mb-2"></i>
                    <h4 class="card-title">  </h4>
                    <p class="card-text">Serviços</p>
                </div>
            </div>
        </div>

               <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-primary" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-file-earmark fs-1 mb-2"></i>
                    <h4 class="card-title">  </h4>
                    <p class="card-text">Assinaturas ativas</p>
                </div>
            </div>
        </div>
               <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-primary" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-file-earmark fs-1 mb-2"></i>
                    <h4 class="card-title"> </h4>
                    <p class="card-text">Destaques Ativos</p>
                </div>
            </div>
        </div>



               


    </div>

</div>

@endsection
