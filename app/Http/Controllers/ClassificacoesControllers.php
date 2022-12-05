<?php

namespace App\Http\Controllers;

use App\Models\AgClassificacao;
use App\Models\AgStatus;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ClassificacoesControllers extends Controller
{
    public function index()
    {
        $usuarioLogado = auth()->user();
        $data_atual = Carbon::now()->format('m/Y');

          $classificacoes = AgClassificacao::query()
            ->with('agquestoes')
            ->orderBy('ag_classificacao')
            ->get();

               
        $blockBotaoForm = AgStatus::where([
        'AG_USUARIO' => $usuarioLogado->id,
       'AG_MATRICULA' => $usuarioLogado->registration,
        'AG_DATA' => $data_atual
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
