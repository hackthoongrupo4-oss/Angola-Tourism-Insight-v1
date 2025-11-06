<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use App\Models\Provincia;
use App\Models\Sugestao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $rules = [
            'data' => 'required|date',
            'ano' => 'required|integer|min:1900|max:2100',
            'mes' => 'required|integer|min:1|max:12',
            //'localidade' => 'required|string|max:191',
            'precipitacao' => 'required|numeric|min:0',
            'precipitacao_media_historica' => 'nullable|numeric|min:0',
            'temperatura_media' => 'required|numeric',
            'temperatura_media_historica' => 'nullable|numeric',
            'temp_maxima' => 'required|numeric',
            'temp_minima' => 'required|numeric',
            'temp_maxima_historica' => 'nullable|numeric',
            'temp_minima_historica' => 'nullable|numeric',
            'feriado' => 'required|in:0,1',
            'nome_feriado' => 'nullable|string|max:200',
        ];
$data = $request->validate($rules);
     /*   

        // se o campo nome_feriado veio via select com outro nome
        if ($request->filled('nome_feriado_select') && $request->nome_feriado_select !== 'Outro') {
            $data['nome_feriado'] = $request->nome_feriado_select;
        }

        // se feriado = 0, limpar nome_feriado
        if ((string)$data['feriado'] === '0') {
            $data['nome_feriado'] = null;
        }

        // converter data para formato correto (opcional)
        $data['data'] = Carbon::parse($data['data'])->toDateString();

        // associar user_id se necessário
        $data['user_id'] = Auth::id();

        // criar previsao
       // $previsao = Previsao::create($data);

        // --- Opcional: enviar para API externa para obter resultado/forecast imediato ---
        // Configure a URL em config/services.php -> 'previsao_api' => ['url' => env('PREVISAO_API_URL')]
        // Se preferires usar, descomente e ajuste conforme necessário.
        /*
        try {
            $apiUrl = config('services.previsao_api.url');
            if ($apiUrl) {
                $response = Http::timeout(10)->post($apiUrl, $previsao->toArray());
                if ($response->successful()) {
                    $result = $response->json();
                    // Exemplo: armazenar o resultado (se tiver coluna) ou guardar em log
                    // $previsao->update(['resultado' => json_encode($result)]);
                    session()->flash('api_result', $result);
                } else {
                    Log::warning('API Previsao respondeu com status ' . $response->status());
                }
            }
        } catch (\Exception $e) {
            Log::error('Erro ao chamar API de previsão: ' . $e->getMessage());
        }
        */



        $min = 1000;
$max = 10000;
$step = 500;

// criar array com os valores possíveis
$valores = range($min, $max, $step);

// pegar um valor aleatório do array
$aleatorio = $valores[array_rand($valores)];

$extremo="";
if($aleatorio<=2500 && $aleatorio>=1000){
$extremo="Baixo";
}else if($aleatorio<=7500 && $aleatorio>2500){
$extremo="Medio";
}else if($aleatorio>7500){
$extremo="Pico";
}

$n_turistas=$aleatorio;
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

    return  view('app.dashboard.paginas.adm.previsoes.resultados',compact('n_turistas','sugestao','itens','data'));
   
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
