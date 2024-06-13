<?php

namespace App\Http\Controllers;


use App\Models\AgQuestoes;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\AgClassificacao;
use App\Models\AgStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Models\AGquestoesLiberadas;


class QuestionsMonthController extends Controller
{
    /**
     * @param integer $id
     * @return View|Factory
     */
    public function index(int $id): View|Factory
    {

        //   dd($id);

        $usuarioLogado = auth()->user();
        $data = date('m');
        $ano = date('Y');
        $mes = $data < 8 ? 2 : 8;

        $dataPadrao = new DateTime("$ano-$mes-01");
        $dataPadrao->modify('last day of this month');
        $datapadrao = $dataPadrao->format('d-m-Y');


        $questoes = AgQuestoes::query()
            ->with('respostas')
            ->where('ag_classificacao', $id)
            ->orderBy('ag_questao')
            ->get();

        $classificacoes = AgClassificacao::query()
            ->where('ag_classificacao', $id)
            ->orderBy('ag_classificacao')
            ->get()
            ->pluck('CLASSIFICACAO')
            ->toArray();


        // dd($id);

        return view('formMonth', [
            'id' => $id,
            'questoes' => $questoes,
            'classificacoes' =>   $classificacoes
        ]);
    }
}
