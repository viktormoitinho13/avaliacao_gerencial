<?php

namespace App\Http\Controllers;

use App\Models\AgClassificacao;
use App\Models\AgGerente;
use App\Models\AgQuestoes;
use App\Models\AgVendedor;
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

        //$blockBotaoForm = AgStatus::where([
        //    'AG_USUARIO' => $usuarioLogado->id,
        //   'AG_MATRICULA' => $usuarioLogado->registration,
        //  'AG_DATA' => $data_atual,
        //])->take(1)->get()->pluck('AG_CLASSIFICACAO')->toArray();

        //  dd($blockBotaoForm);

        return view('home', [
            'classificacoes' => $classificacoes,
            'gerenteNome' => $gerenteNome,
            // 'blockbuttonform' => $blockBotaoForm
        ]);
    }
    public function show()
    {
    }
}