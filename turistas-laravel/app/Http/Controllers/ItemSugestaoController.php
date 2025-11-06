<?php

namespace App\Http\Controllers;

use App\Models\ItemSugestao;
use App\Models\Sugestao;
use Illuminate\Http\Request;

class ItemSugestaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except([]);
    }

    /**
     * Lista os itens de uma sugestão específica.
     * Route: GET sugestao/{sugestao}/itens
     */
    public function index(Sugestao $sugestao)
    {
        // Paginado
        $itens = ItemSugestao::where('sugestao_id', $sugestao->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('app.dashboard.paginas.adm.itemSugestao.index', [
            'sugestao' => $sugestao,
            'itens' => $itens,
        ]);
    }

    /**
     * Store: cria um item ligado a uma sugestão.
     * Route: POST itens_sugestao
     * Espera 'descricao' e 'sugestao_id' no request.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'descricao' => 'required|string|min:3|max:2000',
            'sugestao_id' => 'required|exists:sugestaos,id',
        ]);

        ItemSugestao::create($data);

        return redirect()->route('itens_sugestao.index', $data['sugestao_id'])
            ->with('success', 'Item adicionado com sucesso.');
    }

    /**
     * Update: actualiza um item existente.
     * Route: PUT itens_sugestao/{item}
     */
    public function update(Request $request, ItemSugestao $item)
    {
        $data = $request->validate([
            'descricao' => 'required|string|min:3|max:2000',
            'sugestao_id' => 'sometimes|exists:sugestaos,id',
        ]);

        $item->update(['descricao' => $data['descricao']]);

        // redireciona para a lista de itens da sugestão associada
        return redirect()->route('itens_sugestao.index', $item->sugestao_id)
            ->with('success', 'Item actualizado com sucesso.');
    }

    /**
     * Destroy: apaga um item.
     * Route: DELETE itens_sugestao/{item}
     */
    public function destroy(ItemSugestao $item)
    {
        $sugestaoId = $item->sugestao_id;
        $item->delete();

        return redirect()->route('itens_sugestao.index', $sugestaoId)
            ->with('success', 'Item eliminado com sucesso.');
    }
}
