<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgFeedbackSupervisao;
use Illuminate\Support\Facades\DB;

class feedbackSupervisorController extends Controller
{
    public function index(Request $request)
    {
        $mes = $request->input('mes');
        $ano = $request->input('ano');
        $usuarioLogado = auth()->user();

        if ($mes == null or $ano == null) {
            $mes = date('m');
            $ano = date('Y');
        }

        $feedbackQuery = AgFeedbackSupervisao::query()
            ->leftJoin('vw_historico_gerentes', function ($join) {
                $join
                    ->on('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.LOJA', '=', 'vw_historico_gerentes.LOJA')
                    ->on('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.GERENTE', '=', 'vw_historico_gerentes.GERENTE_ATUAL')
                    ->on('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.SUPERVISOR', '=', 'vw_historico_gerentes.SUPERVISOR')
                    ->whereRaw('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.DATA_FEEDBACK BETWEEN vw_historico_gerentes.DATA_ENTRADA AND ISNULL(vw_historico_gerentes.DATA_SAIDA, DATEADD(DAY, +1,CAST(GETDATE() AS DATE)) )');
            })
            ->select('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.AG_FEEDBACK_SEMESTRAL_SUPERVISAO', 'AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.LOJA', 'vw_historico_gerentes.NOME_SUPERVISOR', 'vw_historico_gerentes.NOME', 'AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.DATA_FEEDBACK', 'AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.OBJETIVO', 'AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.ANOTACOES')
            ->whereMonth('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.DATA_FEEDBACK', $mes)
            ->whereYear('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.DATA_FEEDBACK', $ano);

        if ($usuarioLogado->supervisor == 'S') {
            $feedbackQuery->where('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.SUPERVISOR', $usuarioLogado->registration);
        }

        $id = $request->input('loja');
        if ($id != null) {
            $feedbackQuery->where('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.LOJA', $id);
        }

        $feedbackList = $feedbackQuery->paginate(10);

        return view('feedbackSupervisor', [
            'feedbackList' => $feedbackList,
            'mes' => $mes,
            'ano' => $ano
        ]);
    }
}
