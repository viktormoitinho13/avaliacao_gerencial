<?php

namespace App\Http\Controllers;

use App\Models\AgQuestoes;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\AgClassificacao;
use App\Models\AgStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    /**
     * @param integer $id
     * @return View|Factory
     */
    public function index(int $id): View|Factory
    {

        //dd(2);
        $questoes = AgQuestoes::query()
            ->with('respostas')
            ->where('ag_classificacao', $id)
            ->orderBy('ag_questao')
            ->get();

        $classificacao = AgClassificacao::query()
            ->where('ag_classificacao', $id)
            ->orderBy('ag_classificacao')
            ->get()
            ->pluck('CLASSIFICACAO')
            ->toArray();




        return view('form', [
            'id' => $id,
            'questoes' => $questoes,
            'classificacoes' => $classificacao,
        ]);
    }
}
