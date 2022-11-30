<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\AgQuestoes;
use App\Models\AgResposta;
use Illuminate\Support\Facades\DB;


class QuestionsController extends Controller
{
    public function index($id)
    {   
       $questoes = AgQuestoes::query()->with('respostas')->where('ag_classificacao',$id)->orderBy('ag_questao')->get();
   
        //dd($questoes);
    
       return view('form', compact('questoes'));
    }

    public function show()
    {

    }
}
