<?php

namespace App\Http\Controllers;

use App\Models\AgClassificacao;
use App\Models\AgFormRespostas;
use App\Models\AgGerente;
use App\Models\AgQuestoes;
use App\Models\AgVendedor;
use App\Models\AgStatus;
use App\Models\User;
use Carbon\Carbon;

class ClassificacoesControllers extends Controller
{
    public function index()
    {
        $usuarioLogado = auth()->user();
        $data_atual = Carbon::now()->format('m/Y');
        $classificacoesQuestoes = AgQuestoes::query()
            ->get()->pluck('AG_CLASSIFICACAO')->toArray();

        $loja = User::query()
            ->where('registration', '=', $usuarioLogado->registration)
            ->get()->pluck('store')->toArray();

        $gerenteRegistration = AgGerente::query()
            ->where('LOJA', '=', $loja)
            ->get()->pluck('GERENTE_ATUAL')->toArray();

        $gerenteNome = AgVendedor::query()
            ->where('VENDEDOR', '=', $gerenteRegistration)
            ->get();

        $classificacoes = AgClassificacao::query()
            ->with('agquestoes')
            ->orderBy('ag_classificacao')
            ->whereIn('AG_CLASSIFICACAO', $classificacoesQuestoes)
            ->take(1)->get();


        $contarStatus = AgStatus::query()
            ->distinct()
            ->select('AG_CLASSIFICACAO')
            ->where('AG_MATRICULA', '=', $usuarioLogado->registration)
            ->get()->count('AG_CLASSIFICACAO');

        //  DD($contarStatus);
        $contarQuestoes = AgQuestoes::query()
            ->distinct()
            ->select('AG_CLASSIFICACAO')
            ->get()->count('AG_CLASSIFICACAO');

        // DD($contarQuestoes);

        return view('home', [
            'classificacoes' => $classificacoes,
            'gerenteNome' => $gerenteNome,
            'contarStatus' => $contarStatus,
            'contarQuestoes'  => $contarQuestoes
            // 'blockbuttonform' => $blockBotaoForm
        ]);
    }
    public function show()
    {
    }
}