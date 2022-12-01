<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RespostasQuestoes extends Controller
{
    public function store(int $id)
    {

        try {
            foreach (request()->input('questao') as $questao => $resposta) {

                $datasave = [
                    'AG_CLASSIFICACAO' => $id,
                    'AG_RESPOSTA' => $resposta,
                    'AG_QUESTAO' => $questao,
                    'AG_USUARIO' => auth()->id(),
                    'AG_MATRICULA' => auth()->user()->getAttribute('registration'),
                ];
                DB::table('AG_FORM_RESPOSTAS')->insert($datasave);
                return redirect('/home');
            }

        } catch (\Throwable$th) {
        ?> 
        <script type="text/javascript">
        alert("Você já concluiu esse formulário");
        window.location.href = "/home";
        </script>
        <?php
        }

    }
}

//
