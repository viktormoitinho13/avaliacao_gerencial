<?php

namespace App\Http\Controllers;

use App\Models\AgClassificacao;
use App\Models\AgQuestoes;
use App\Models\AgStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ClassificacoesControllers extends Controller
{
    public function index()
    {
        $usuarioLogado = auth()->user();
        $data_atual = Carbon::now()->format('m/Y');

        $classificacoesQuestoes = AgQuestoes::query()
        ->get()->pluck('AG_CLASSIFICACAO')->toArray();    

       

        $classificacoes = AgClassificacao::query()
            ->with('agquestoes')
            ->orderBy('ag_classificacao')
            ->whereIn('AG_CLASSIFICACAO',   $classificacoesQuestoes)
            ->get();

   //  dd($classificacoes);
       
        $blockBotaoForm = AgStatus::where([
            'AG_USUARIO' => $usuarioLogado->id,
            'AG_MATRICULA' => $usuarioLogado->registration,
            'AG_DATA' => $data_atual,
        ])->get()->pluck('AG_CLASSIFICACAO')->toArray();

        // dd($blockBotaoForm);

        return view('home', [
            'classificacoes' => $classificacoes,
            'blockbuttonform' => $blockBotaoForm
        ]);

    }
    public function show()
    {
    }
}
