<?php

namespace App\Http\Controllers;

use App\Models\AgFormRespostas;
use Illuminate\Support\Facades\DB;


class RelatorioController extends Controller
{
    public function index()
    {
        $results = DB::select('
                       SELECT 
                        count(DISTINCT A.AG_RESPOSTA) as qtd_respostas,
                        E.AG_CLASSIFICACAO, 
                        E.CLASSIFICACAO,  
                        CONVERT(DECIMAL(15,2),AVG(B.NOTA)) AS MEDIA_NOTA,
                        DATEPART(MONTH, CONVERT(DATETIME, A.DATA_RESPOSTAS)) AS MES_RESPOSTA,
                        DATEPART(YEAR, CONVERT(DATETIME, A.DATA_RESPOSTAS)) AS ANO_RESPOSTA
		
		                FROM AG_FORM_RESPOSTAS A
                        LEFT JOIN (
                                        SELECT 
                                        CONVERT(VARCHAR(MAX), AG_RESPOSTA ) AS  AG_RESPOSTA, 
                                        AG_QUESTAO, 
                                        RESPOSTA,
                                        NOTA  
                                        FROM AG_RESPOSTAS
                                ) B 
                                                    ON A.AG_RESPOSTA = B.AG_RESPOSTA 
                        JOIN AG_QUESTOES D 			ON D.AG_QUESTAO = B.AG_QUESTAO 
                        JOIN AG_CLASSIFICACAO E 	ON E.AG_CLASSIFICACAO = A.AG_CLASSIFICACAO
                        WHERE A.AG_LOJA = ?
                        GROUP BY 
                            E.AG_CLASSIFICACAO, 
                            E.CLASSIFICACAO,	
                            A.AG_LOJA,
                            A.DATA_RESPOSTAS', [auth()->user()->store]);

        return view('report', [
            'results' => $results
        ]);
    }
}