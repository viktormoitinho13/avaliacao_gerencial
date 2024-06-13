<?php

namespace App\Http\Controllers;


use App\Models\AgClassificacao;
use App\Models\AgQuestoes;
use App\Models\AgFormRespostas;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Models\AgFeedbackSupervisao;

class managerHomeController extends Controller
{
    public function index()
    {
        $usuarioLogado = auth()->user();
        $mesAtual = date('m');
        $ano = date('Y');
        $mes = date('m') < 8 ? 2 : 8;
        $dataPadrao = new DateTime("$ano-$mes-01");
        $dataPadrao->modify('last day of this month');


        if ($mes == 2) {
            $dataBase = '01-03-' . $ano;
            $dataLimiteFeedback = '01-08-' . $ano;
        } elseif ($mes == 8) {
            $dataBase = '01-09-' . $ano;
            $dataLimiteFeedback = '01-02-' . $ano + 1;
        }

        $contagemLojas = AgFormRespostas::where('NOME_GERENTE', $usuarioLogado->name)
            ->whereMonth('DATA_RESPOSTA_COMPLETA', $mes)
            ->whereYear('DATA_RESPOSTA_COMPLETA', $ano)
            ->distinct('AG_LOJA')
            ->count();


        $resultado = AgFormRespostas::query()
            ->select('NOME_GERENTE', 'AG_LOJA')
            ->where('NOME_GERENTE', $usuarioLogado->name)
            ->whereMonth('DATA_RESPOSTA_COMPLETA', $mes)
            ->whereYear('DATA_RESPOSTA_COMPLETA', $ano)
            ->distinct()
            ->get();

        return view('managerHome', [
            'resultado' => $resultado,
            'contagemLojas' => $contagemLojas,
        ]);
    }
}
