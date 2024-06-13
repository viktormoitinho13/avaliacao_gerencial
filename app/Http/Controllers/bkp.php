<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgFeedbackSupervisao;
use App\Models\AgFeedbackSupervisaoDetail;


class pdiFormAnswersController extends Controller
{
    public function store(Request $request)
    {

        $usuarioLogado = auth()->user();
        $controlador = 1;

        // VARIAVEIS ENVIADOS PELO FORMULÁRIO
        $dados = $request->all();

        // dd($dados);

        $dataFeedback = $dados['dataFeedback'];
        $objetivo = $dados['objetivo'];
        list($loja, $gerente) = explode('|', $dados['gerente']);
        $anotacao = $dados['anotacao'];



        // VARIAVEIS ENVIADOS PELO FORMULARIO QUE PODEM SER OU NÃO ARRAYS
        // Inicializar arrays para armazenar os valores agrupados
        $desenvolver = [];
        $reconhecer = [];
        $dataDe = [];
        $dataAte = [];
        $acao = [];
        $entrega = [];
        $recurso = [];
        $status = [];


        // Iterar sobre os dados para agrupar os valores com base nos índices numéricos
        foreach ($dados as $key => $value) {
            // Verificar se a chave termina com um número
            if (preg_match('/(\D+)(\d+)$/', $key, $matches)) {
                $prefix = $matches[1]; // Obter o prefixo (ex: "desenvolver", "reconhecer", etc.)
                $index = $matches[2];  // Obter o índice numérico (ex: "1", "2", etc.)

                // Agrupar valores com base no prefixo
                switch ($prefix) {
                    case 'desenvolver':
                        $desenvolver[$index] = $value;
                        break;
                    case 'reconhecer':
                        $reconhecer[$index] = $value;
                        break;
                    case 'dataDe':
                        $dataDe[$index] = $value;
                        break;
                    case 'dataAte':
                        $dataAte[$index] = $value;
                        break;
                    case 'acao':
                        $acao[$index] = $value;
                        break;
                    case 'entrega':
                        $entrega[$index] = $value;
                        break;
                    case 'recurso':
                        $recurso[$index] = $value;
                        break;
                    case 'status':
                        $status[$index] = $value;
                        break;
                        // Adicione outros casos conforme necessário
                }
            }
        }

        // Obter o número máximo de elementos entre todos os arrays
        $numElementos = max(
            count($desenvolver),
            count($reconhecer),
            count($dataDe),
            count($dataAte),
            count($acao),
            count($entrega),
            count($recurso),
            count($status)
        );

        AgFeedbackSupervisao::create([
            'LOJA' => $loja,
            'GERENTE' => $gerente,
            'DATA_FEEDBACK' => $dataFeedback,
            'OBJETIVO' => $objetivo,
            'ANOTACOES' => $anotacao
        ]);


        $registroFeedback = AgFeedbackSupervisao::query()
            ->select('ag_feedback_semestral_supervisao')
            ->where('LOJA', $loja)
            ->where('GERENTE', $gerente)
            ->max('ag_feedback_semestral_supervisao');


        for ($i = 1; $i <= $numElementos; $i++) {
            AgFeedbackSupervisao::create([
                'AG_FEEDBACK_SEMESTRAL_SUPERVISAO' => $registroFeedback,
                'HABILIDADES_DESENVOLVER' => $desenvolver[$i],
                'HABILIDADES_RECONHECER' =>  $reconhecer[$i],
                'DATA_INICIAL_PLANO_ACAO' => $dataDe[$i],
                'DATA_FINAL_PLANO_ACAO' =>  $dataAte[$i],
                'ACAO_PLANO_ACAO' =>  $acao[$i],
                'ENTREGA_PLANO_ACAO' =>  $entrega[$i],
                'RECURSO_PLANO_ACAO' => $recurso[$i],
                'STATUS_PLANO_ACAO' =>  $status[$i]
            ]);
        }




        return view('home');
    }
}
