<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgFormRespostas;
use Illuminate\Support\Facades\DB;


class RelatorioDocController extends Controller
{
    public function index(int $id)
    {
        $qtd_respostas = DB::SELECT('
                            
            SELECT 
                    COUNT( DISTINCT AG_USUARIO) AS QTD_TOTAL_RESPOSTAS 
                    FROM AG_FORM_RESPOSTAS 
            WHERE AG_LOJA = ?
        ', [$id]);


        $cabecalho = DB::select('
        SELECT
        C.AG_CLASSIFICACAO ,
        C.CLASSIFICACAO  ,
        CONVERT (DECIMAL(15,2), sum(b.nota) / count(a.AG_RESPOSTA)) as MEDIA 
        FROM AG_FORM_RESPOSTAS A
        JOIN(SELECT 
                CONVERT(VARCHAR(MAX),AG_RESPOSTA ) AS AG_RESPOSTA,
                NOTA 
                FROM AG_RESPOSTAS
        ) B ON A.AG_RESPOSTA = B.AG_RESPOSTA 
        JOIN AG_CLASSIFICACAO C  ON A.AG_CLASSIFICACAO = C.AG_CLASSIFICACAO 
        WHERE AG_LOJA = ?
        GROUP BY 
        C.AG_CLASSIFICACAO ,
        C.CLASSIFICACAO  
        ORDER BY C.AG_CLASSIFICACAO ASC 
        ', [$id]);

        $notaFinal = collect($cabecalho)->sum('MEDIA') /  collect($cabecalho)->count();
        $notaFinal = number_format((float)$notaFinal, 2, '.', '');

        // DD($qtd_respostas);
        //dd(collect($cabecalho)->sum('MEDIA'));
        // dd(collect($cabecalho)->count());
        return view('reportDoc', [
            'cabecalho' => $cabecalho,
            'notaFinal' => $notaFinal,
            'qtd_respostas' => $qtd_respostas
        ]);
    }
}