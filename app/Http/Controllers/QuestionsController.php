<?php

namespace App\Http\Controllers;

use App\Models\AgQuestoes;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class QuestionsController extends Controller
{
    /**
     * @param int $id
     * @return View|Factory
     */
    public function index(int $id): View|Factory
    {
        $questoes = AgQuestoes::query()
            ->with('respostas')
            ->where('ag_classificacao', $id)
            ->orderBy('ag_questao')
            ->get();

        return view('form', [
            'id' => $id,
            'questoes' => $questoes,
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
