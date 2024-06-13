<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AGquestoesLiberadas;

class authorizeQuestionController extends Controller
{
    public function store(Request $request)
    {
        $usuarioLogado = auth()->user();
        $gerente = $request->gerente;
        $classificacoes = $request->classificacoes;
        list($loja, $gerentenome) = explode(' - ', $request->gerente);

        $data_atual = date('d/m/Y');
        $mes = date('m') < 8 ? 2 : 8;
        $dataLimite = $mes < 8 ? '01/' . '08/' . date('Y') : '01/' . '02/' . date('Y', strtotime('+1 year'));


        try {
            foreach ($classificacoes as $classificacao) {
                AGquestoesLiberadas::create([
                    'SUPERVISOR' => $usuarioLogado->registration,
                    'LOJA' => $loja,
                    'GERENTE' => $gerentenome,
                    'ID_CLASSIFICACAO' => $classificacao,
                    'DATA_AUTORIZACAO' => $data_atual,
                    'DATA_LIMITE_RESPOSTA' => $dataLimite
                ]);
            }

            return redirect("/releaseQuestions");
        } catch (\Throwable $th) {
            return redirect("/home")
                ->withInput()
                ->with(['err' => 'Dados já foram inseridos.']);
        }
    }
}
