<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgFormRespostas;
use Illuminate\Support\Facades\DB;
use App\Models\AgQuestoes;
use App\Models\AgClassificacao;
use App\Models\AgFeedbackSupervisao;
use App\Models\AgFeedbackSupervisaoDetail;
use DateTime;


class RelatorioDocController extends Controller
{
    public function index(int $id)
    {

        $usuarioLogado = auth()->user();
        $data = date('m');
        $mesBase = $data < 8 ? 2 : 8;
        $anoBase = date('Y');
        $dataAtual = date('d-m-Y');
        if ($mesBase == 2) {
            $dataBase = '01-03-' . $anoBase;
            $dataLimite = '01-08-' . $anoBase;
        } elseif ($mesBase == 8) {
            $dataBase = '01-09-' . $anoBase;
            $dataLimite = '01-02-' . $anoBase + 1;
        }



        $usuarioLogado->store;
        $usuarioLogado->registration;

        $qtd_respostas = AgFormRespostas::query()
            ->where('AG_FORM_RESPOSTAS.AG_LOJA', $id)
            ->whereYear('AG_FORM_RESPOSTAS.DATA_RESPOSTA_COMPLETA', $anoBase)
            ->whereMonth('AG_FORM_RESPOSTAS.DATA_RESPOSTA_COMPLETA', '<=', $mesBase)
            ->distinct('AG_FORM_RESPOSTAS.AG_MATRICULA')
            ->count('AG_FORM_RESPOSTAS.AG_MATRICULA');

        // dd($qtd_respostas);

        $cabecalho = DB::select('
                SELECT
                C.AG_CLASSIFICACAO ,
                C.CLASSIFICACAO  ,
                case 
                    when CONVERT (DECIMAL(15,2), sum(b.nota) / count(a.AG_RESPOSTA)) > 0 then CONVERT (DECIMAL(15,2), sum(b.nota) / count(a.AG_RESPOSTA))
                    else 0
                end as MEDIA 
                FROM AG_FORM_RESPOSTAS A
                JOIN(SELECT 
                        CONVERT(VARCHAR(MAX),AG_RESPOSTA ) AS AG_RESPOSTA,
                        NOTA 
                        FROM AG_RESPOSTAS
                ) B ON A.AG_RESPOSTA = B.AG_RESPOSTA 
                JOIN AG_CLASSIFICACAO C  ON A.AG_CLASSIFICACAO = C.AG_CLASSIFICACAO 
                WHERE AG_LOJA = ?
                AND YEAR(A.DATA_RESPOSTA_COMPLETA) = ?
                AND MONTH(A.DATA_RESPOSTA_COMPLETA) <= ?   
                GROUP BY 
                C.AG_CLASSIFICACAO ,
                C.CLASSIFICACAO  
                ORDER BY C.AG_CLASSIFICACAO ASC 
        ', [$id, $anoBase, $mesBase]);

        $notaFinal = collect($cabecalho)->sum('MEDIA') /  collect($cabecalho)->count();
        $notaFinal = number_format((float)$notaFinal, 2, '.', '');

        $classificacoes = AgClassificacao::query()
            ->get()
            ->pluck('AG_CLASSIFICACAO')
            ->toArray();

        $gerentePercepcao = DB::select("
                                       SELECT 
                                       A.AG_CLASSIFICACAO,
                                       A.CLASSIFICACAO,
                                         CASE
                                       		WHEN COMENTARIO = 'N' THEN STRING_AGG(CONCAT(CONVERT(DECIMAL(15,0),PORCENTAGEM),'% ','dizem que ', RESPOSTA), ', ')
                                       		WHEN COMENTARIO = 'S' THEN CONCAT('Comentário: ', RESPOSTA) 
                                       		END AS ANALISE 
                                       FROM AG_GERENTE_PERCEPCAO A
                                        JOIN AG_QUESTOES B ON A.AG_QUESTAO = B.AG_QUESTAO 
                                        WHERE AG_LOJA = ?
                                        AND A.MES <= ?  
                                        AND A.ANO = ?
                                        GROUP BY A.AG_QUESTAO, B.QUESTAO, A.AG_CLASSIFICACAO, A.CLASSIFICACAO,COMENTARIO,RESPOSTA
                                        ORDER BY A.AG_CLASSIFICACAO ASC 
                                          ", [$id, $mesBase, $anoBase]);

        $gerenteAgrupamento = [];
        foreach ($gerentePercepcao as $gerentePercepcao) {
            $gerenteAgrupamento[$gerentePercepcao->CLASSIFICACAO][] = [$gerentePercepcao->ANALISE];
        }

        $feedbackMain = AgFeedbackSupervisao::query()
            ->where('LOJA', $usuarioLogado->store)
            ->where('gerente', $usuarioLogado->registration)
            ->where('data_feedback', '>=', $dataBase)
            ->where('data_feedback', '<', $dataLimite)
            ->first();



        return view('reportDoc', [
            'cabecalho' => $cabecalho,
            'notaFinal' => $notaFinal,
            'qtd_respostas' => $qtd_respostas,
            'gerenteAgrupamento' => $gerenteAgrupamento,
            'classificacoes' => $classificacoes,
            'feedbackMain' => $feedbackMain
        ]);
    }
}
