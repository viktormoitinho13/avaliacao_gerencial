<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgFormRespostas;
use Illuminate\Support\Facades\DB;
use App\Models\AgQuestoes;
use App\Models\AgClassificacao;


class RelatorioDocController extends Controller
{
    public function index(int $id)
    {
        $data_atual = date('m/Y');
        $qtd_respostas = DB::SELECT('
                            
            SELECT 
                    COUNT( DISTINCT AG_USUARIO) AS QTD_TOTAL_RESPOSTAS 
                    FROM AG_FORM_RESPOSTAS 
            WHERE AG_LOJA = ?
            AND DATA_RESPOSTAS = ? 
        ', [$id, $data_atual]);

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
        AND A.DATA_RESPOSTAS = ?
        GROUP BY 
        C.AG_CLASSIFICACAO ,
        C.CLASSIFICACAO  
        ORDER BY C.AG_CLASSIFICACAO ASC 
        ', [$id, $data_atual]);

        $notaFinal = collect($cabecalho)->sum('MEDIA') /  collect($cabecalho)->count();
        $notaFinal = number_format((float)$notaFinal, 2, '.', '');
        // $cabecalho = number_format((float)$cabecalho, 2, '.', '');

        //dd(collect($cabecalho)->toArray());
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
                                        AND A.DATA_RESPOSTAS = ?
                                        GROUP BY A.AG_QUESTAO, B.QUESTAO, A.AG_CLASSIFICACAO, A.CLASSIFICACAO,COMENTARIO,RESPOSTA
                                        ORDER BY A.AG_CLASSIFICACAO ASC 
                                        
                                        
                                          ", [$id,  $data_atual]);

        //dd(collect($gerentePercepcao)->pluck('PORCENTAGEM')->toArray());
        $gerenteAgrupamento = [];
        foreach ($gerentePercepcao as $gerentePercepcao) {
            $gerenteAgrupamento[$gerentePercepcao->CLASSIFICACAO][] = [$gerentePercepcao->ANALISE];
        }



        // dd($gerenteAgrupamento);

        return view('reportDoc', [
            'cabecalho' => $cabecalho,
            'notaFinal' => $notaFinal,
            'qtd_respostas' => $qtd_respostas,
            'gerenteAgrupamento' => $gerenteAgrupamento,
            'classificacoes' => $classificacoes
        ]);
    }
}