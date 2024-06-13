<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgFeedbackSupervisao;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class managerFeedbackHistoryController extends Controller
{
    public function index(Request $request)
    {
        $mes = $request->input('mes');
        $ano = $request->input('ano');
        $usuarioLogado = auth()->user();

        // Iniciar a construção da consulta
        $query = AgFeedbackSupervisao::query()
            ->select('LOJA', 'GERENTE', DB::raw("FORMAT(DATA_FEEDBACK, 'dd/MM/yyyy') as DATA_FEEDBACK"))
            ->where('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.GERENTE', $usuarioLogado->registration);


        $id = $request->input('loja');
        if ($id != null) {

            $query->where('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO.LOJA', $id);
        }

        // Verificar se mes ou ano é nulo, buscar o registro mais recente se for o caso
        if ($mes === null || $ano === null) {
            $query->orderBy('DATA_FEEDBACK', 'desc'); // Supondo que 'DATA_FEEDBACK' é seu campo de timestamp
        } else {
            $query->whereMonth('DATA_FEEDBACK', $mes)
                ->whereYear('DATA_FEEDBACK', $ano);
        }

        // Usar paginate no construtor da consulta
        $historyFeedbackManagers = $query->paginate(10);

        return view('managerFeedbackHistory', [
            'historyFeedbackManagers' => $historyFeedbackManagers
        ]);
    }
}
