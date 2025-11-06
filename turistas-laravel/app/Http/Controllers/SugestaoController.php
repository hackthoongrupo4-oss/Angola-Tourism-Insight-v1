<?php

namespace App\Http\Controllers;

use App\Models\Sugestao;
use Illuminate\Http\Request;

class SugestaoController extends Controller
{
    // Se quiseres proteger via middleware
    public function __construct()
    {
        $this->middleware('auth')->except([]);
    }

    public function index()
    {
        $sugestaos = Sugestao::orderBy('created_at', 'desc')->paginate(10);
        return view('app.dashboard.paginas.adm.sugestoes.index', compact('sugestaos'));
    }

    public function create()
    {
        // não usado se estivermos a usar modal; mantido por convensão
        return view('app.dashboard.sugestaos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|min:3|max:150',
        ]);

        $sugestao = Sugestao::create($data);

        return redirect()->route('sugestaos.index')
            ->with('success', 'Sugestão criada com sucesso.');
    }

    public function show(Sugestao $sugestao)
    {
        // poderíamos redirecionar para os itens:
        return redirect()->route('itens_sugestao.index', $sugestao->id);
    }

    public function edit(Sugestao $sugestao)
    {
        // Se usar modal, provavelmente não precisas disto.
        return view('app.dashboard.sugestaos.edit', compact('sugestao'));
    }

    public function update(Request $request, Sugestao $sugestao)
    {
        $data = $request->validate([
            'nome' => 'required|string|min:3|max:150',
        ]);

        $sugestao->update($data);

        return redirect()->route('sugestaos.index')
            ->with('success', 'Sugestão actualizada com sucesso.');
    }

    public function destroy(Sugestao $sugestao)
    {
        // Apaga em cascade (se migration configurada)
        $sugestao->delete();

        return redirect()->route('sugestaos.index')
            ->with('success', 'Sugestão eliminada com sucesso.');
    }
}
