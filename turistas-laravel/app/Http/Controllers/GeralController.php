<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Illuminate\Http\Request;

class GeralController extends Controller
{
    //
    public function index(){

        $arquivos=Arquivo::where('status','aprovado')->get();
        return  view('app.index',compact('arquivos'));
    }

        public function lista(){

        $arquivos=Arquivo::where('status','aprovado')->paginate(20);
        return  view('app.arquivos.index',compact('arquivos'));
    }

            public function show(Arquivo $arquivo){


        return  view('app.arquivos.show',compact('arquivo'));
    }
}
