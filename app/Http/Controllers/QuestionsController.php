<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\AgQuestoes;

use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    public function index($id)
    {   
        $questoes = AgQuestoes::query()->where('ag_classificacao',$id)->orderBy('ag_questao')->get();
      // $questoes = AgQuestoes::all();
      


       return view('form', compact('questoes'));
    }

    public function show()
    {

    }
}
