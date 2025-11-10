<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use App\Models\Sugestao;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class previsaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('app.dashboard.paginas.provincia.previsoes.criar');

    }












    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     $rules = [
 
    'ano' => 'required|integer|min:1900|max:2100',
    'mes' => 'required|integer|min:1|max:12',
    'precipitacao' => 'required|numeric|min:0',
    'precipitacao_media_historica' => 'nullable|numeric|min:0',
    'temperatura_media' => 'required|numeric',
    'temperatura_media_historica' => 'nullable|numeric',
    'temp_maxima' => 'required|numeric',
    'temp_minima' => 'required|numeric',
    'temp_maxima_historica' => 'nullable|numeric',
    'temp_minima_historica' => 'nullable|numeric',
    'feriado' => 'required|in:0,1',
   
   
];

$data = $request->validate($rules);
$provincia=Auth::user()->gestor->provincia;

    
     $payload = [
        "ano" => $request->ano,
        "mes" => $request->mes,
        "precipitacao" => $request->precipitacao,
        "precipitacao_media_historica" => $request->precipitacao_media_historica,
        "temperatura_media" => $request->temperatura_media,
        "temperatura_media_historica" => $request->temperatura_media_historica,
        "temp_maxima" => $request->temp_maxima,
        "temp_minima" =>$request->temp_minima,
        "temp_maxima_historica" => $request->temp_maxima_historica,
        "temp_minima_historica" => $request->temp_minima_historica,
        "feriado" => $request->feriado,
        "localidade_Benguela" =>$provincia->nome=="Benguela"?1:0,
        "localidade_Luanda" => $provincia->nome=="Luanda"?1:0,
        "localidade_Lubango" => $provincia->nome=="Huila"?1:0
    ];
     try {
            // Chamada para a API Flask (rodando localmente na porta 5000)
            $response = Http::post('http://127.0.0.1:5000/prever', $payload);

            if ($response->failed()) {
                return back()->with('erro', 'Erro na API Flask: ' . $response->body());
            }

            $respo = $response->json();

            if(isset($respo['erro'])){
                return back()->with('erro', 'Erro na API Flask: ' . $respo['erro']);
            }

            // Sucesso: você pode salvar no DB ou mostrar a previsão
            $previsao = $respo['previsao'] ?? null;
 
           // return back()->with('sucesso', 'Previsão gerada: ' . $previsao);

        } catch (Exception $e) {
            // Captura qualquer erro de conexão ou exceção
            return back()->with('erro', 'Erro ao conectar com a API Flask: ' . $e->getMessage());
        }


        $min = 1000;
$max = 10000;
$step = 500;

// criar array com os valores possíveis
//$valores = range($min, $max, $step);

// pegar um valor aleatório do array
//$aleatorio = $valores[array_rand($valores)];

$extremo="";
if($previsao<=2500 && $previsao>=1000){
$extremo="Baixo";
}else if($previsao<=7500 && $previsao>2500){
$extremo="Medio";
}else if($previsao>7500){
$extremo="Pico";
}else{
    $extremo="Pico";
}
//dd($previsao);
$n_turistas=$previsao;
    $sugestao=Sugestao::where('nome',$extremo)->first();
    if ($sugestao) {
    // Pega até 4 itens aleatórios
    $itens = $sugestao->itens()->inRandomOrder()->take(10)->get();
} else {
    $itens = collect(); // coleção vazia caso não haja sugestão
}

Historico::create([
    'n_turistas' => (int) $n_turistas,
    'data' => $data, // Laravel vai armazenar como JSON (cast 'array')
    'nome_sugestao' => $sugestao ? $sugestao->nome : null,
    'tipos_sugestoes' => $itens->pluck('descricao')->toArray(),
    'user_id' => Auth::id(),
    // opcionalmente, se tens provincia_id no request (ou deduzes da sessão do gestor):
    'provincia_id' => $request->get('provincia_id') ?? (Auth::user()->gestor->provincia_id ?? null),
]);

    return  view('app.dashboard.paginas.provincia.previsoes.resultados',compact('n_turistas','sugestao','itens','data'));
   
}

public function index(){
   $provincia= Auth::user()->gestor->provincia;
    $historicos=$provincia->historicos()->paginate(20);

    return view('app.dashboard.paginas.provincia.previsoes.index',compact('historicos'));
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $historico=Historico::findOrFail($id);
        return view('app.dashboard.paginas.provincia.previsoes.show',compact('historico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $previsao=Historico::findOrFail($id);
        $previsao->delete();
        return redirect()->back()->with('success','Previsão elminada com sucesso!');
    }
}
