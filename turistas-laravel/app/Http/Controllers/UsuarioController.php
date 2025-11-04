<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    //
    public function index(){
        $user=Auth::user();
        if($user->hasRole('admin')){
            return view('app.dashboard.dashboard1');
        }else{
            return view('app.dashboard.dashboard2');
        }
    }
}
