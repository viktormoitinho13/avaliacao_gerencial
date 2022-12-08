<?php

namespace App\Http\Controllers;

use App\Models\AgQuestoes;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\AgClassificacao;
use App\Models\AgResposta;
use Illuminate\Support\Facades\DB;


class QuestionsController extends Controller
{
    /**
     * @param int $id
     * @return View|Factory
     */
    public function index(int $id): View | Factory
    {
        $questoes = AgQuestoes::query()
            ->with('respostas')
            ->where('ag_classificacao', $id)
            ->orderBy('ag_questao')
            ->get();

        $classificacao = AgClassificacao::query()
            ->SELECT('CLASSIFICACAO')
            ->where('ag_classificacao', $id)
            ->orderBy('ag_classificacao')
            ->get()->pluck('CLASSIFICACAO')->toArray();

        // DD($classificacao);

        $dissertativa = DB::table('AG_QUESTOES')
            ->leftJoin('AG_RESPOSTAS', 'AG_QUESTOES.AG_QUESTAO', '=', 'AG_RESPOSTAS.AG_QUESTAO')
            ->whereNotNull('AG_QUESTOES.AG_QUESTAO')
            ->whereNull('AG_RESPOSTAS.AG_QUESTAO')
            ->get()->pluck('AG_RESPOSTA')->toArray();



        //  dd($dissertativa);



        //dd($classificacao);
        return view('form', [
            'id' => $id,
            'questoes' => $questoes,
            'classificacao' => $classificacao,
            'dissertativa' => $dissertativa
        ]);
    }

    /**
     * @return void
     */
    public function show(): void
    {
    }

    /**
     * @return void
     */
}