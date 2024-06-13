<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgFeedbackSupervisao;
use App\Models\AgFeedbackSupervisaoDetail;
use Illuminate\Support\Facades\DB;
use App\Models\AgManagerSelfPerception;

class managerFeedbackMonthController extends Controller
{
    public function index(Request $request)
    {
        $usuarioLogado = auth()->user();
        $data_feedback = $request->input('data_feedback');
        $data_feedback = \DateTime::createFromFormat('d/m/Y', $data_feedback);
        $mes = $data_feedback->format('m');
        $ano = $data_feedback->format('Y');
        $loja = $request->loja;


        $feedbackDescription = AgFeedbackSupervisao::query()
            ->leftJoin('vw_historico_gerentes', function ($join) {
                $join
                    ->on('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.LOJA', '=', 'vw_historico_gerentes.LOJA')
                    ->on('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.GERENTE', '=', 'vw_historico_gerentes.GERENTE_ATUAL')
                    ->whereRaw('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.DATA_FEEDBACK BETWEEN vw_historico_gerentes.DATA_ENTRADA AND ISNULL(vw_historico_gerentes.DATA_SAIDA, GETDATE())');
            })
            ->where('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.LOJA', $loja)
            ->where('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.GERENTE', $usuarioLogado->registration)
            ->whereMonth('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.DATA_FEEDBACK', $mes)
            ->whereYear('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.DATA_FEEDBACK', $ano)
            ->select('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.AG_FEEDBACK_SEMESTRAL_SUPERVISAO', 'vw_historico_gerentes.NOME', 'AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.LOJA', 'AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.OBJETIVO', 'AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.ANOTACOES', DB::raw('CONVERT(VARCHAR(15), AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.DATA_FEEDBACK, 103) AS DATA_FEEDBACK'), 'vw_historico_gerentes.NOME_SUPERVISOR')
            ->get();

        // Coletando os IDs dos feedbacks semestrais
        $feedbackSemestralIDs = $feedbackDescription->pluck('AG_FEEDBACK_SEMESTRAL_SUPERVISAO');

        // Consulta detalhada usando os IDs coletados
        $feedbackDetails = AgFeedbackSupervisaoDetail::query()
            ->select('HABILIDADES_DESENVOLVER', 'HABILIDADES_RECONHECER')
            ->whereIn('AG_FEEDBACK_SEMESTRAL_SUPERVISAO', $feedbackSemestralIDs)
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
            ->where('AG_FEEDBACK_SEMESTRAL_SUPERVISAO', '=', $feedbackSemestralIDs)
            ->whereNotNull('DATA_INICIAL_PLANO_ACAO')
            ->get();


        $feedbackSelfPerception = AgManagerSelfPerception::query()
            ->where('AG_FEEDBACK_SEMESTRAL_SUPERVISAO', '=', $feedbackSemestralIDs)
            ->first();

        // $feedbackRegister = $feedbackSelfPerception->isNotEmpty();

        $feedbackSelfPerceptionConfirmation = $feedbackSelfPerception ? 'S' : 'N';

        $feedbackManagerCheck = $feedbackSelfPerception ? ($feedbackSelfPerception->checkfeedback ? 'S' : 'N') : 'N';


        if ($feedbackSelfPerception !== null) {
            $feedbackSelfPerception = $feedbackSelfPerception->get();
        } else {
            // Faça algo se $feedbackSelfPerception for null
        }




        return view('feedbackReportMonth', [
            'feedbackDetails' => $feedbackDetails,
            'feedbackDetailsPlanosAcoes' => $feedbackDetailsPlanosAcoes,
            'feedbackDescription' => $feedbackDescription,
            'feedbackSelfPerception' => $feedbackSelfPerception,
            'feedbackSelfPerceptionConfirmation' => $feedbackSelfPerceptionConfirmation,
            'feedbackManagerCheck' =>  $feedbackManagerCheck
        ]);
    }
}
