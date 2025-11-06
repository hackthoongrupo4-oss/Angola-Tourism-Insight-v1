<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Arquivos2Controller extends Controller
{
    //

     public function index()
    {
        
        $arquivos = Arquivo::latest()->paginate(12) ;
        return view('app.dashboard.paginas.adm.arquivos.index', compact('arquivos'));
    }

    // Form para criar arquivo
    public function create()
    {
        return view('app.dashboard.paginas.prestador.arquivos.create');
    }

    // Armazenar arquivo
    
    // show detalhe
    public function show(Arquivo $arquivo)
    {
      //  $arquivo=Arquivo::findOrFail($arquivo);
         // implementar policy se quiser
       
 
        return view('app.dashboard.paginas.adm.arquivos.show', compact('arquivo'));
    }

    // download público/autenticado
 
public function download(Arquivo $arquivo)
{
    $disk = Storage::disk('public');
    $path = $arquivo->arquivo_path;

    // caminho físico dentro de storage/app/public
    $full = storage_path('app/public/' . $path);

    // 1) Verifica se existe no disk 'public'
    if ($disk->exists($path)) {
        return $disk->download($path, $arquivo->titulo . '.' . pathinfo($path, PATHINFO_EXTENSION));
    }

    // 2) Fallback: se o ficheiro existir fisicamente (por segurança)
    if (file_exists($full)) {
        return response()->download($full, $arquivo->titulo . '.' . pathinfo($path, PATHINFO_EXTENSION));
    }

    // 3) Se não existir — 404 com mensagem clara
    abort(404, 'Ficheiro não encontrado no servidor. Path verificado: ' . $path);
}

    // excluir (apenas o prestador ou admin)
    public function destroy(Arquivo $arquivo)
    {
        $user = Auth::user();
        if ($user->id !== $arquivo->prestador->user_id && !$user->hasRole('admin')) {
            abort(403);
        }

        Storage::disk('public')->delete($arquivo->arquivo_path);
        $arquivo->delete();

        return redirect()->route('arquivos.index')->with('success', 'Arquivo removido.');
    }

    // opcional: endpoint para aprovar (admin)
    public function aprovar(Request $request, Arquivo $arquivo)
    {
        $this->authorize('aprovar', $arquivo); // implementar policy/role

        $arquivo->status = 'aprovado';
        $arquivo->aprovado_em = now();
        $arquivo->aprovado_por = $request->user()->id;
        $arquivo->save();

        return back()->with('success', 'Arquivo aprovado.');
    }

    public function updateStatus(Request $request, Arquivo $arquivo)
{
    $request->validate([
        'status' => 'required|in:pendente,aprovado,arquivado',
    ]);

    $arquivo->status = $request->status;
    $arquivo->save();

    return redirect()->back()->with('success', 'Status do arquivo atualizado com sucesso!');
}

}
