<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AgFormRespostas;

class RespostasQuestoes extends Controller
{
    public function store(int $id): void
    {
        foreach (request()->input('questao') as $questao => $resposta) {
            //dump('Questão: ' . $questao, ' Resposta:' . $resposta);
           // dd($questao, $resposta, $id);
           
            
            $datasave = [
            'AG_QUESTAO' => $id,
            'AG_RESPOSTA' => $resposta,
            'AG_CLASSIFICACAO' => $questao
            ];
            DB::table('AG_FORM_RESPOSTAS')->insert($datasave);
        }
       
    }
}
