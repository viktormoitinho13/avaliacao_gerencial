<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class historyClassificacations extends Controller
{
    public function index($id, $gerente, $loja)
    {

        // dd($id, $gerente, $loja);
        $cabecalhoAnual = DB::select("
        SELECT
            MONTH(A.DATA_RESPOSTA_COMPLETA) AS MES,      
            YEAR(A.DATA_RESPOSTA_COMPLETA) AS ANO,
            C.AG_CLASSIFICACAO,
            C.CLASSIFICACAO,
            CASE 
                WHEN CONVERT(DECIMAL(15, 2), SUM(B.nota) / COUNT(A.AG_RESPOSTA)) > 0 
                THEN CONVERT(DECIMAL(15, 2), SUM(B.nota) / COUNT(A.AG_RESPOSTA))
                ELSE 0
            END AS MEDIA 
        FROM AG_FORM_RESPOSTAS A
        JOIN (
            SELECT 
                CONVERT(VARCHAR(MAX), AG_RESPOSTA) AS AG_RESPOSTA,
                NOTA 
            FROM AG_RESPOSTAS
        ) B ON A.AG_RESPOSTA = B.AG_RESPOSTA 
        JOIN AG_CLASSIFICACAO C ON A.AG_CLASSIFICACAO = C.AG_CLASSIFICACAO 
        WHERE 
            A.GERENTE = ?
            AND C.AG_CLASSIFICACAO = ?
           
        GROUP BY 
            C.AG_CLASSIFICACAO,
            C.CLASSIFICACAO,
            MONTH(A.DATA_RESPOSTA_COMPLETA),
            YEAR(A.DATA_RESPOSTA_COMPLETA) 
        ORDER BY 
            MONTH(A.DATA_RESPOSTA_COMPLETA),      
            YEAR(A.DATA_RESPOSTA_COMPLETA) 
    ", [$gerente, $id]);

        $mediaAnual = DB::select("
        
 	SELECT 
 	
 		A.ANO,
 		A.AG_CLASSIFICACAO,
 		A.CLASSIFICACAO,
 		CONVERT(NUMERIC(15,2),AVG(A.MEDIA))  AS MEDIA_ANO
 	
    FROM  (
 	SELECT 
            MONTH(A.DATA_RESPOSTA_COMPLETA) AS MES,      
            YEAR(A.DATA_RESPOSTA_COMPLETA) AS ANO,
            C.AG_CLASSIFICACAO,
            C.CLASSIFICACAO,
            CASE 
                WHEN CONVERT(DECIMAL(15, 2), SUM(B.nota) / COUNT(A.AG_RESPOSTA)) > 0 
                THEN CONVERT(DECIMAL(15, 2), SUM(B.nota) / COUNT(A.AG_RESPOSTA))
                ELSE 0
            END AS MEDIA 
        FROM AG_FORM_RESPOSTAS A
        JOIN (
            SELECT 
                CONVERT(VARCHAR(MAX), AG_RESPOSTA) AS AG_RESPOSTA,
                NOTA 
            FROM AG_RESPOSTAS
        ) B ON A.AG_RESPOSTA = B.AG_RESPOSTA 
        JOIN AG_CLASSIFICACAO C ON A.AG_CLASSIFICACAO = C.AG_CLASSIFICACAO 
        WHERE 
            A.GERENTE = ?
            AND C.AG_CLASSIFICACAO = ?
          
        GROUP BY 
            C.AG_CLASSIFICACAO,
            C.CLASSIFICACAO,
            MONTH(A.DATA_RESPOSTA_COMPLETA),
            YEAR(A.DATA_RESPOSTA_COMPLETA) 
  
	) A   
		GROUP BY 
 		A.ANO,
 		A.AG_CLASSIFICACAO,
 		A.CLASSIFICACAO
    ", [$gerente, $id]);


        // dd($cabecalhoAnual, $mediaAnual);

        return view('chartHistoryClassifications', [
            'cabecalhoAnual' => $cabecalhoAnual,
            'mediaAnual' => $mediaAnual
        ]);
    }
}
