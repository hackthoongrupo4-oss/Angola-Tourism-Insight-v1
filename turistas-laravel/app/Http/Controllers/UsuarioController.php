<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use App\Models\Gestor;
use App\Models\Historico;
use App\Models\ItemSugestao;
use App\Models\Prestador;
use App\Models\Provincia;
use App\Models\Sugestao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    //
    public function create_user(){
        return view('app.auth.register');
    }
    public function index(){
        $user=Auth::user();
        if($user->hasRole('admin')){
            $n_prev=Historico::count();
            $n_users=Gestor::count();
            $n_prov=Provincia::count();
            $n_sugestao=Sugestao::count();
            $n_item=ItemSugestao::count();
            $n_a=Arquivo::count();
            $n_a_ap=Arquivo::where('status','aprovado')->count();
            $n_a_p=Arquivo::where('status','pendente')->count();
            $n_a_n=Arquivo::where('status','arquivado')->count();
            $n_prest=Prestador::count();
            return view('app.dashboard.dashboard1',compact('n_prev','n_users','n_prov','n_sugestao','n_item','n_a','n_a_ap'
            ,'n_a_p','n_a_n','n_prest'
            ));
        }else if($user->hasRole('gestor')){
            $n_previsoes=Auth::user()->gestor->provincia->historicos()->count();
            $n_usuarios=Auth::user()->gestor->provincia->gestores()->count();
            return view('app.dashboard.dashboard2',compact('n_previsoes','n_usuarios'));
        }else{
    $n_a=Auth::user()->prestador->arquivos()->count();
            $n_a_ap=Auth::user()->prestador->arquivos()->where('status','aprovado')->count();
            $n_a_p=Auth::user()->prestador->arquivos()->where('status','pendente')->count();
            $n_a_n=Auth::user()->prestador->arquivos()->where('status','arquivado')->count();
            return view('app.dashboard.dashboard3',compact('n_a','n_a_ap'
            ,'n_a_p','n_a_n',));
        }
    }
    public function usuarios(Provincia $provincia){
        $gestores = Gestor::where('provincia_id', $provincia->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('app.dashboard.paginas.adm.gestores.index', [
            'gestores' => $gestores,
            'provincia' => $provincia,
        ]);
    }
    public function destroy(User $user){
     
        $user->delete();
        
        return redirect()->back()->with('success','Usuario deletado com sucesso');
    }
}
