<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgFormRespostas;
use Illuminate\Support\Facades\DB;
use App\Models\AgQuestoes;
use App\Models\AgClassificacao;
use Date;
use Dflydev\DotAccessData\Data;

class RelatorioController extends Controller
{

    public function index(int $id, Request $request)
    {
        $usuarioLogado = auth()->user();
        $data = date('m');
        $ano = date('Y');

        $mes = $data < 8 ? 2 : 8;


        $qtd_respostas = AgFormRespostas::query()
            ->where('AG_FORM_RESPOSTAS.AG_LOJA', $id)
            ->whereYear('AG_FORM_RESPOSTAS.DATA_RESPOSTA_COMPLETA', $ano)
            ->whereMonth('AG_FORM_RESPOSTAS.DATA_RESPOSTA_COMPLETA', '<=', $mes)
            ->distinct('AG_FORM_RESPOSTAS.AG_MATRICULA')
            ->count('AG_FORM_RESPOSTAS.AG_MATRICULA');


        // dd($qtd_respostas);

        $cabecalho = DB::select("
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
        AND MONTH(DATA_RESPOSTA_COMPLETA) = ?
        AND YEAR(DATA_RESPOSTA_COMPLETA) = ?
        GROUP BY 
        C.AG_CLASSIFICACAO ,
        C.CLASSIFICACAO  
        ORDER BY C.AG_CLASSIFICACAO ASC 
        ", [$id, $mes, $ano]);

        if (collect($cabecalho)->count() > 0) {

            $notaFinal = collect($cabecalho)->sum('MEDIA') /  collect($cabecalho)->count();
            $notaFinal = number_format((float)$notaFinal, 2, '.', '');
        } else $notaFinal = 0;

        $classificacoes = AgClassificacao::query()
            ->select('AG_CLASSIFICACAO')
            ->get()
            ->toArray();

        $gerentePercepcao = DB::select("
                                    SELECT 
                                     CONCAT(UPPER(SUBSTRING(A.CLASSIFICACAO, 1,1)), LOWER(SUBSTRING(A.CLASSIFICACAO, 2,LEN (A.CLASSIFICACAO)))) AS CLASSIFICACAO,
  									 B.QUESTAO AS QUESTAO,
                                     A.AG_CLASSIFICACAO,
                                     CASE
                                     WHEN COMENTARIO = 'N' THEN STRING_AGG(CONCAT(CONVERT(DECIMAL(15,0),PORCENTAGEM),'% ','dizem que ', LOWER(RESPOSTA)), ', ')
                                      WHEN COMENTARIO = 'X' THEN CONCAT(CONVERT(DECIMAL(15,0),PORCENTAGEM),'% ','deram a nota ', LOWER(RESPOSTA),' para o gerente.' )
                                     WHEN COMENTARIO = 'S' THEN LOWER(RESPOSTA) END AS ANALISE 
                                     FROM AG_GERENTE_PERCEPCAO A
                                     JOIN AG_QUESTOES B ON A.AG_QUESTAO = B.AG_QUESTAO 
                                     WHERE AG_LOJA = ?
                                     AND A.ANO = ?
                                     AND A.MES = ?
                                     GROUP BY A.AG_QUESTAO, B.QUESTAO, A.AG_CLASSIFICACAO, A.CLASSIFICACAO,COMENTARIO,RESPOSTA,  B.QUESTAO,PORCENTAGEM
                                     ORDER BY A.AG_CLASSIFICACAO ASC 
                                          ",  [$id, $ano, $mes]);
        //dd(collect($gerentePercepcao)->pluck('PORCENTAGEM')->toArray());

        $gerenteAgrupamentos = [];

        foreach ($gerentePercepcao as $gerentePercepcao) {
            $gerenteAgrupamentos[$gerentePercepcao->CLASSIFICACAO][$gerentePercepcao->QUESTAO][] = $gerentePercepcao->ANALISE;
        }


        $gerenteNome = AgFormRespostas::query()
            ->select(DB::raw(" concat(Upper(substring(NOME_GERENTE, 1,1)), lower(substring(NOME_GERENTE, 2,LEN(NOME_GERENTE))), '...') as nome"))
            ->where('AG_FORM_RESPOSTAS.AG_LOJA', $id)
            ->whereYear('AG_FORM_RESPOSTAS.DATA_RESPOSTA_COMPLETA', $ano)
            ->whereMonth('AG_FORM_RESPOSTAS.DATA_RESPOSTA_COMPLETA', '<=', $mes)
            ->distinct()
            ->get();


        return view('reportDocCorporate', [
            'cabecalho' => $cabecalho,
            'notaFinal' => $notaFinal,
            'qtd_respostas' => $qtd_respostas,
            'gerenteAgrupamento' => $gerenteAgrupamentos,
            'classificacoes' => $classificacoes,
            'id' => $id,
            'data' => $data,
            'usuario' => $usuarioLogado,
            'gerenteNome' => $gerenteNome
        ]);
    }
}
