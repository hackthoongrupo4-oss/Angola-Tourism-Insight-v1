<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Prestador;
use Symfony\Component\HttpFoundation\StreamedResponse;
class ArquivoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // ajuste se quiseres permitir anónimos
    }


    

    // Lista "meus arquivos"
    public function index()
    {
        $user = Auth::user();
        $prestador = $user->prestador;
        $arquivos = $prestador ? $prestador->arquivos()->latest()->paginate(12) : collect();
        return view('app.dashboard.paginas.prestador.arquivos.index', compact('arquivos'));
    }

    // Form para criar arquivo
    public function create()
    {
        return view('app.dashboard.paginas.prestador.arquivos.create');
    }

    // Armazenar arquivo
    public function store(Request $request)
    {
        $user = Auth::user();

        // garante que o user tem prestador
        $prestador = $user->prestador ;

        $rules = [
            'titulo' => 'required|string|max:191',
            'descricao' => 'nullable|string|max:4000',
            'arquivo' => 'required|file|max:10240|mimes:csv,txt,xls,xlsx,ods,doc,docx,pdf,zip', // 10MB
        ];

        $validated = $request->validate($rules);

        $file = $request->file('arquivo');
        $origName = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $mime = $file->getClientMimeType();
        $size = $file->getSize();

        // cria filename seguro
        $filename = Str::slug(pathinfo($origName, PATHINFO_FILENAME)) . '-' . time() . '.' . $ext;

        // guarda no disk 'public/arquivos'
        $path = $file->storeAs('arquivos', $filename, 'public');

        $arquivo = Arquivo::create([
            'prestador_id' => $prestador->id,
            'titulo' => $validated['titulo'],
            'descricao' => $validated['descricao'] ?? null,
            'arquivo_path' => $path,
            'mime' => $mime,
            'size' => $size,
            'status' => 'pendente',
        ]);

        return redirect()->route('arquivos.index')->with('success', 'Arquivo enviado com sucesso. Aguarda aprovação.');
    }

    // show detalhe
    public function show(Arquivo $arquivo)
    {
        
         // implementar policy se quiser
        return view('app.dashboard.paginas.prestador.arquivos.show', compact('arquivo'));
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
}
