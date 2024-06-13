<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgGerente;
use App\Models\AgFormRespostas;
use App\Models\AgClassificacao;
use App\Models\AGquestoesLiberadas;
use Illuminate\Support\Facades\DB;


class ReleaseMonthlyQuestions extends Controller
{
    public function index()
    {
        $usuarioLogado = auth()->user();
        $mes = date('m') < 8 ? 2 : 8;
        $ano = date('Y');


        $lojasSupervisionadas =
            AgFormRespostas::query()
            ->leftJoin('vw_historico_gerentes', function ($join) {
                $join->on('AG_FORM_RESPOSTAS.AG_LOJA', '=', 'vw_historico_gerentes.LOJA');
            })
            ->leftJoin('AG_CLASSIFICACAO', function ($join) {
                $join->on('AG_FORM_RESPOSTAS.AG_CLASSIFICACAO', '=', 'AG_CLASSIFICACAO.AG_CLASSIFICACAO');
            })
            ->leftJoin('AG_LIBERACAO_QUESTOES_MENSAIS', function ($join) {
                $join->on('AG_FORM_RESPOSTAS.AG_LOJA', '=', 'AG_LIBERACAO_QUESTOES_MENSAIS.LOJA')
                    ->on('AG_FORM_RESPOSTAS.AG_CLASSIFICACAO', '=', 'AG_LIBERACAO_QUESTOES_MENSAIS.ID_CLASSIFICACAO')
                    ->on('AG_FORM_RESPOSTAS.DATA_RESPOSTA_COMPLETA', '<', 'AG_LIBERACAO_QUESTOES_MENSAIS.DATA_LIMITE_RESPOSTA');
            })

            ->select(
                DB::raw("AG_FORM_RESPOSTAS.AG_LOJA as LOJA"),
                DB::raw('vw_historico_gerentes.GERENTE_ATUAL'),
                DB::raw('AG_CLASSIFICACAO.AG_CLASSIFICACAO'),
                DB::raw("CONCAT(UPPER(SUBSTRING(AG_CLASSIFICACAO.CLASSIFICACAO, 1, 1)), LOWER(SUBSTRING(AG_CLASSIFICACAO.CLASSIFICACAO, 2, 500))) AS CLASSIFICACAO "),
                DB::raw("CONCAT(vw_historico_gerentes.LOJA, ' - ', vw_historico_gerentes.NOME) AS NOME_GERENTE")
            )
            ->WHERE('vw_historico_gerentes.SUPERVISOR', $usuarioLogado->registration)
            ->whereYear('AG_FORM_RESPOSTAS.DATA_RESPOSTA_COMPLETA', $ano)
            ->whereMonth('AG_FORM_RESPOSTAS.DATA_RESPOSTA_COMPLETA', $mes)
            ->whereNull('vw_historico_gerentes.DATA_SAIDA')
            ->whereNull('AG_LIBERACAO_QUESTOES_MENSAIS.AG_LIBERACAO_QUESTAO_MENSAL')
            ->distinct()
            ->get();


        //dd($lojasSupervisionadas);

        $lojasSupervisionadasAgrupamentos = [];

        foreach ($lojasSupervisionadas as $lojaSupervisionada) {
            $lojasSupervisionadasAgrupamentos[$lojaSupervisionada->NOME_GERENTE][$lojaSupervisionada->AG_CLASSIFICACAO] = $lojaSupervisionada->CLASSIFICACAO;
        }




        return view('releaseQuestion', [
            'lojasSupervisionadas' => $lojasSupervisionadasAgrupamentos

        ]);
    }
}
