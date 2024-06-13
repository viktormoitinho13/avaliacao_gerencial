<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgFormRespostas;
use App\Models\AgGerente;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Models\AgFeedbackSupervisao;

class PdiFormController extends Controller
{
    public function index()
    {

        $usuarioLogado = auth()->user();
        $ano = date('Y');
        $mes = date('m') < 8 ? 2 : 8;
        $dataAtual = date('d-m-Y');
        $dataPadrao = new DateTime("$ano-$mes-01");
        $dataPadrao->modify('last day of this month');

        if ($mes == 2) {
            $dataBase = '01-03-' . $ano;
            $dataLimiteFeedback = '01-08-' . $ano;
        } elseif ($mes == 8) {
            $dataBase = '01-09-' . $ano;
            $dataLimiteFeedback = '01-02-' . $ano + 1;
        }

        $gerentes = AgFormRespostas::query()
            ->select('a.AG_LOJA', 'a.GERENTE', 'a.NOME_GERENTE', DB::raw("concat(a.AG_LOJA, ' - ', a.NOME_GERENTE) as gerente_atual"))
            ->from('AG_FORM_RESPOSTAS as a')
            ->whereMonth('a.DATA_RESPOSTA_COMPLETA', $mes)
            ->whereYear('a.DATA_RESPOSTA_COMPLETA', $ano)
            ->whereIn('a.AG_LOJA', function ($query) use ($usuarioLogado) {
                $query->select('LOJA')
                    ->from(with(new AgGerente)->getTable())
                    ->where('SUPERVISOR', $usuarioLogado->registration)
                    ->whereNull('DATA_SAIDA');
            })
            ->whereNotIn('a.GERENTE', function ($query) use ($dataBase, $dataLimiteFeedback) {
                $query->select('GERENTE')
                    ->from('AG_FEEDBACK_SEMESTRAIS_SUPERVISAO')
                    ->where('data_feedback', '>=', $dataBase)
                    ->where('data_feedback', '<', $dataLimiteFeedback);
            })
            ->distinct()
            ->get();




        return view('pdiForm', [
            'gerentes' => $gerentes,
            'dataAtual' => $dataAtual
        ]);
    }
}
