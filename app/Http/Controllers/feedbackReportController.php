<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgFeedbackSupervisao;
use App\Models\AgFeedbackSupervisaoDetail;
use Illuminate\Support\Facades\DB;
use App\Models\AgManagerSelfPerception;


class FeedbackReportController extends Controller
{
    public function index(int $id)
    {

        //dd(1);
        $usuarioLogado = auth()->user();

        $supervisor = $usuarioLogado->supervisor;

        $feedbackDescription = AgFeedbackSupervisao::query()
            ->leftJoin('vw_historico_gerentes', function ($join) {
                $join
                    ->on('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.LOJA', '=', 'vw_historico_gerentes.LOJA')
                    ->on('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.GERENTE', '=', 'vw_historico_gerentes.GERENTE_ATUAL')
                    ->whereRaw('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.DATA_FEEDBACK BETWEEN vw_historico_gerentes.DATA_ENTRADA AND ISNULL(vw_historico_gerentes.DATA_SAIDA, GETDATE())');
            })->where('AG_FEEDBACK_SEMESTRAL_SUPERVISAO', $id)
            ->select('vw_historico_gerentes.NOME', 'AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.LOJA', 'AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.OBJETIVO', 'AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.ANOTACOES', DB::raw('CONVERT(VARCHAR(15), AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.DATA_FEEDBACK, 103) AS DATA_FEEDBACK'), 'vw_historico_gerentes.NOME_SUPERVISOR')
            ->get();


        $feedbackDetails = AgFeedbackSupervisaoDetail::query()
            ->select('HABILIDADES_DESENVOLVER', 'HABILIDADES_RECONHECER')
            ->where('AG_FEEDBACK_SEMESTRAL_SUPERVISAO', '=', $id)
            ->get();


        $feedbackDetailsPlanosAcoes = AgFeedbackSupervisaoDetail::query()
            ->select(
                DB::raw("FORMAT(DATA_INICIAL_PLANO_ACAO, 'dd/MM/yyyy') as DATA_INICIAL_PLANO_ACAO"),
                DB::raw("FORMAT(DATA_FINAL_PLANO_ACAO, 'dd/MM/yyyy') as DATA_FINAL_PLANO_ACAO"),
                'ACAO_PLANO_ACAO',
                'ENTREGA_PLANO_ACAO',
                'RECURSO_PLANO_ACAO',
                'STATUS_PLANO_ACAO'
            )
            ->where('AG_FEEDBACK_SEMESTRAL_SUPERVISAO', '=', $id)
            ->whereNotNull('DATA_INICIAL_PLANO_ACAO')
            ->get();


        $feedbackSelfPerception = AgManagerSelfPerception::query()
            ->where('AG_FEEDBACK_SEMESTRAL_SUPERVISAO', '=', $id)
            ->first();

        // $feedbackRegister = $feedbackSelfPerception->isNotEmpty();

        $feedbackSelfPerceptionConfirmation = $feedbackSelfPerception ? 'S' : 'N';

        $feedbackManagerCheck = $feedbackSelfPerception ? ($feedbackSelfPerception->checkfeedback ? 'S' : 'N') : 'N';


        if ($feedbackSelfPerception !== null) {
            $feedbackSelfPerception = $feedbackSelfPerception->get();
        } else {
            // Faça algo se $feedbackSelfPerception for null
        }




        return view('feedbackReport', [

            'feedbackDetails' => $feedbackDetails,
            'feedbackDetailsPlanosAcoes' => $feedbackDetailsPlanosAcoes,
            'feedbackDescription' => $feedbackDescription,
            'id' => $id,
            'feedbackSelfPerception' => $feedbackSelfPerception,
            'feedbackSelfPerceptionConfirmation' => $feedbackSelfPerceptionConfirmation,
            'feedbackManagerCheck' =>  $feedbackManagerCheck,
            'supervisor' => $supervisor

        ]);
    }
}
