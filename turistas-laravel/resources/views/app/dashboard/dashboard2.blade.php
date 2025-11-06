@extends('app.dashboard.layouts.app')

@section('title','Painel')
 

@section('content')

<div class="container-fluid py-4">

   
   

    <h3 class="my-4">Provincia : {{Auth::user()->gestor->provincia->nome}}</h3>
    <div class="row g-4">
     

         <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-warning" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-file-text fs-1 mb-2"></i>
                    <h4 class="card-title"> {{$n_previsoes}} </h4>
                    <p class="card-text">Total de previsões</p>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card shadow-sm d-flex flex-row">
                <div class="bg-primary" style="width: 5px;"></div>
                <div class="card-body text-center flex-grow-1">
                    <i class="bi bi-file-earmark fs-1 mb-2"></i>
                    <h4 class="card-title">{{$n_usuarios}} </h4>
                    <p class="card-text">Número de usuarios</p>
                </div>
            </div>
        </div>

      

      

       

       
      



               


    </div>

</div>

@endsection
