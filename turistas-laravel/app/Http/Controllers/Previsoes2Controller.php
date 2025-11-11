<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use App\Models\Provincia;
use App\Models\Sugestao;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Previsoes2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
      public function create()
    {
        //
        $provincias=Provincia::all();
        return view('app.dashboard.paginas.adm.previsoes.criar',compact('provincias'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
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
  'localidade_Benguela' => 'nullable|in:0,1',
    'localidade_Luanda' => 'nullable|in:0,1',
    'localidade_Lubango' => 'nullable|in:0,1',
];

$data = $request->validate($rules);

 
 //dd($request->localidade_Benguela,$request->localidade_Luanda,$request->localidade_Lubango);

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
        "localidade_Benguela" => $request->localidade_Benguela,
        "localidade_Luanda" => $request->localidade_Luanda,
        "localidade_Lubango" => $request->localidade_Lubango
    ];


     try {
            // Chamada para a API Flask (rodando localmente na porta 5000)
            $response = Http::post('http://127.0.0.1:5000/prever', $payload);

            if ($response->failed()) {
                return back()->with('erro', 'Erro na API Flask: ' . $response->body());
            }

            $respo = $response->json();

            if(isset( $respo['erro'])){
                return back()->with('erro', 'Erro na API Flask: ' .  $respo['erro']);
            }

            // Sucesso: você pode salvar no DB ou mostrar a previsão
            $previsao =  $respo['previsao'] ?? null;
 
           // return back()->with('sucesso', 'Previsão gerada: ' . $previsao);

        } catch (Exception $e) {
            // Captura qualquer erro de conexão ou exceção
            return back()->with('erro', 'Erro ao conectar com a API Flask: ' . $e->getMessage());
        }



    if($request->localidade_Benguela){
        $provincia=Provincia::where('nome','Benguela')->first();
    }else if($request->localidade_Luanda){
        $provincia=Provincia::where('nome','Luanda')->first();
    }else if($request->localidade_Lubango){
        $provincia=Provincia::where('nome','Huila')->first();

    }

 
$extremo="";
 
        if($provincia->nome=="Benguela"){
            $desvio1=444.1;
            $maximo1=3747;
            $minimo1=1256;
            $media1=2345.5;
            
            if($previsao<($media1-$desvio1)){
                $extremo="Baixo";
            }else if($previsao>=($media1-$desvio1) && $previsao<=($media1+$desvio1)){
$extremo="Medio";
            }else if($previsao>($media1+$desvio1)){
$extremo="Pico";
            }


        }else if($provincia->nome=="Luanda"){
            $desvio2=1583.06;
            $maximo2=11279;
            $minimo2=1913;
            $media2=3434.4;
            if($previsao<($media2-$desvio2)){
$extremo="Baixo";
            }else if($previsao>=($media2-$desvio2) && $previsao<=($media2+$desvio2)){
$extremo="Medio";
            }else if($previsao>($media2+$desvio2)){
$extremo="Pico";
            }

        }else if($provincia->nome=="Huila"){
            $desvio3=110.7;
            $maximo3=926;
            $minimo3=310;
            $media3=580.8;

            if($previsao<($media3-$desvio3)){
$extremo="Baixo";
            }else if($previsao>=($media3-$desvio3) && $previsao<=($media3+$desvio3)){
$extremo="Medio";
            }else if($previsao>($media3+$desvio3)){
$extremo="Pico";
            }

        }else{
            return redirect()->back()>with('error',"Não foi possivel encontrar uma provincia");
        }



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

    return  view('app.dashboard.paginas.adm.previsoes.resultados',compact('n_turistas','sugestao','itens','data','extremo'));
     } catch (Exception $e) {
        dd($e->getMessage());
            // Captura qualquer erro de conexão ou exceção
            return back()->with('erro', 'Erro  : ' . $e->getMessage());
        }
}

public function index(){
 
    $historicos=Historico::paginate(20);

    return view('app.dashboard.paginas.adm.previsoes.index',compact('historicos'));
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $historico=Historico::findOrFail($id);
        return view('app.dashboard.paginas.adm.previsoes.show',compact('historico'));
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
