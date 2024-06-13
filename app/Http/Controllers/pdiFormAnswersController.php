<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgFeedbackSupervisao;
use App\Models\AgFeedbackSupervisaoDetail;
use DateTime;

class pdiFormAnswersController extends Controller
{
    public function store(Request $request)
    {


        $usuarioLogado = auth()->user();


        $mesAtual = date('m');
        $ano = date('Y');
        $mes = date('m') < 8 ? 2 : 8;
        $dataPadrao = new DateTime("$ano-$mes-01");
        $dataPadrao->modify('last day of this month');


        if ($mes == 2) {
            $dataBase = '01-03-' . $ano;
            $dataLimiteFeedback = '01-08-' . $ano;
        } elseif ($mes == 8) {
            $dataBase = '01-09-' . $ano;
            $dataLimiteFeedback = '01-02-' . $ano + 1;
        }


        // VARIAVEIS ENVIADOS PELO FORMULÁRIO
        $dados = $request->all();

        //dd($dados);

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
            'ANOTACOES' => $anotacao,
            'SUPERVISOR' => $usuarioLogado->registration
        ]);


        $registroFeedback = AgFeedbackSupervisao::query()
            ->select('ag_feedback_semestral_supervisao')
            ->where('LOJA', $loja)
            ->where('GERENTE', $gerente)
            ->max('ag_feedback_semestral_supervisao');


        for ($i = 1; $i <= $numElementos; $i++) {
            AgFeedbackSupervisaoDetail::create([
                'AG_FEEDBACK_SEMESTRAL_SUPERVISAO' => $registroFeedback,
                'HABILIDADES_DESENVOLVER' => $desenvolver[$i] ?? null,
                'HABILIDADES_RECONHECER' =>  $reconhecer[$i] ?? null,
                'DATA_INICIAL_PLANO_ACAO' => $dataDe[$i] ?? null,
                'DATA_FINAL_PLANO_ACAO' =>  $dataAte[$i] ?? null,
                'ACAO_PLANO_ACAO' =>  $acao[$i] ?? null,
                'ENTREGA_PLANO_ACAO' =>  $entrega[$i] ?? null,
                'RECURSO_PLANO_ACAO' => $recurso[$i] ?? null,
                'STATUS_PLANO_ACAO' =>  $status[$i] ?? null
            ]);
        }

        $feedbackMain = AgFeedbackSupervisao::query()
            ->select('AG_FEEDBACK_SEMESTRAL_SUPERVISAO')
            ->where('LOJA', $usuarioLogado->store)
            ->where('data_feedback', '>=', $dataBase)
            ->where('data_feedback', '<', $dataLimiteFeedback)
            ->first();

        $result = $feedbackMain ? 'S' : 'N';


        return view('home', [
            'feedbackMain' => $result
        ]);
    }
}
