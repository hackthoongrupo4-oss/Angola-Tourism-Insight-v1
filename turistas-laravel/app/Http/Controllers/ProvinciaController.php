<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __contruct(){
        $this->middleware('roles:admin')->only(['destroy']);
    }
    public function index()
    {
        try {
            
            $provincias = Provincia::paginate(10);
            return view('app.dashboard.paginas.adm.provincias.index', compact('provincias'));
        } catch (Exception $e) {
            Log::error("Erro ao listar províncias: " . $e->getMessage());
            return redirect()->route('dashboard1')->with("error", "Ocorreu um erro ao carregar as províncias.");
        }
    }

    /**
     * Gerar um slug único.
     */
    public function gerarSlug($para)
    {
        $slugBase = Str::slug($para);
        $slug = $slugBase;
        $contador = 1;

        while (Provincia::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $contador;
            $contador++;
        }

        return $slug;
    }

    /**
     * Atualizar o slug se o nome for alterado.
     */
    public function atualizarSlug($para, $provincia)
    {
        if ($para !== $provincia->nome) {
            $slugBase = Str::slug($para);
            $slug = $slugBase;
            $contador = 1;

            while (Provincia::where('slug', $slug)->where('id', '!=', $provincia->id)->exists()) {
                $slug = $slugBase . '-' . $contador;
                $contador++;
            }

            $provincia->slug = $slug;
          
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
                               
            $request->validate([
                    'nome' => [
        'required',
        'string',
        'min:3',
        'max:100',
        'regex:/^[A-Za-zÀ-ÖØ-öø-ÿÇç0-9][A-Za-zÀ-ÖØ-öø-ÿÇç0-9 ]{2,}$/u',"unique:provincias,nome,"
    ],
              
            ]);
            DB::beginTransaction();
            

            Provincia::create([
                'nome' => $request->nome,
               
            ]);
            DB::commit();
            return redirect()->route('provincias.index')->with('success', 'Província adicionada com sucesso!');
        } catch (Exception $e) {
                        DB::rollBack();
            Log::error("Erro ao criar província: " . $e->getMessage());
            return redirect()->back()->with("error", "Erro ao adicionar província : ". $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
                               
            $request->validate([
                    'nome' => [
        'required',
        'string',
        'min:3',
        'max:100',
        'regex:/^[A-Za-zÀ-ÖØ-öø-ÿÇç0-9][A-Za-zÀ-ÖØ-öø-ÿÇç0-9 ]{2,}$/u',"unique:provincias,nome,".$id
    ],
 
            ]);

            $provincia = Provincia::findOrFail($id);
            DB::beginTransaction();
           

            $provincia->update([
               'nome' => $request->nome,
              //  'slug' => $provincia->slug,
            ]);
            DB::commit();
            return redirect()->route('provincias.index')->with("success", "Província atualizada com sucesso!");
        } catch (Exception $e) {
                        DB::rollBack();
            Log::error("Erro ao atualizar província: " . $e->getMessage());
            return redirect()->route('provincias.index')->with("error", "Erro ao atualizar província : ". $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
                               
            DB::beginTransaction();
            $provincia = Provincia::findOrFail($id);
            $provincia->delete();
            DB::commit();
            return redirect()->route("provincias.index")->with("success", "Província deletada com sucesso!");
        } catch (Exception $e) {
                        DB::rollBack();
            Log::error("Erro ao deletar província: " . $e->getMessage());
            return redirect()->route('provincias.index')->with("error", "Erro ao deletar província : ". $e->getMessage());
        }
    }
}
