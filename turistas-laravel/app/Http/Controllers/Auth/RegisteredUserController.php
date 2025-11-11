<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Gestor;
use App\Models\Prestador;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try{


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'provincia_id'=>'nullable',
            'chave'=>'nullable',
        ]);
         
        DB::beginTransaction();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        event(new Registered($user));

        if($request->chave==1){
            Gestor::create([
            'provincia_id'=>$request->provincia_id,
            'user_id'=>$user->id,
         ]);
        
        Role::firstOrCreate(['name'=>'gestor']);
        $user->syncRoles('gestor');
        }else{

            Prestador::create([
                'user_id'=>$user->id
            ]);

             Role::firstOrCreate(['name'=>'prestador']);
        $user->syncRoles('prestador');
         Auth::login($user);
        DB::commit();
        return redirect()->route('dashboard1')->with('success',"Usuario adicionado com sucesso");
        }
             
        DB::commit();
        return redirect()->back()->with('success',"Usuario adicionado com sucesso");
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','Ocorreu um erro'.$e->getMessage());
        }
    }
}
