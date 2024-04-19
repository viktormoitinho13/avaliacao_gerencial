<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgFormRespostas;
use Illuminate\Support\Facades\DB;
use App\Models\AgQuestoes;
use App\Models\AgClassificacao;
use DateTime;

class RelatorioController extends Controller
{

    public function index(int $id)
    {
        $usuarioLogado = auth()->user();
        $data = date('m');
        $dataAv = date('m/Y');
        $ano = date('Y');

        if ($data <= 6) {
            $dt_ini = ('01' . '/' . '01' . '/' . date('Y'));
            $dt_fim = ('31' . '/' . '06' . '/' . date('Y'));
            $semestre = 1;
        } else {
            $dt_ini = ('01' . '/' . '07' . '/' . date('Y'));
            $dt_fim = ('31' . '/' . '12' . '/' . date('Y'));
            $semestre = 2;
        }

        // Convertendo para objetos DateTime
        $dt_ini_obj = DateTime::createFromFormat('d/m/Y', $dt_ini);
        $dt_fim_obj = DateTime::createFromFormat('d/m/Y', $dt_fim);

        $qtd_respostas = DB::SELECT("
                            
            SELECT 
                    COUNT( DISTINCT AG_MATRICULA) AS QTD_TOTAL_RESPOSTAS 
                    FROM AG_FORM_RESPOSTAS 
            WHERE AG_LOJA = ?
             AND DATA_RESPOSTA_COMPLETA BETWEEN ? AND ?   
        ", [$id, $dt_ini_obj, $dt_fim_obj]);

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
        AND A.DATA_RESPOSTA_COMPLETA BETWEEN ? AND ?  
        GROUP BY 
        C.AG_CLASSIFICACAO ,
        C.CLASSIFICACAO  
        ORDER BY C.AG_CLASSIFICACAO ASC 
        ", [$id, $dt_ini_obj, $dt_fim_obj]);

        if (collect($cabecalho)->count() > 0) {

            $notaFinal = collect($cabecalho)->sum('MEDIA') /  collect($cabecalho)->count();
            $notaFinal = number_format((float)$notaFinal, 2, '.', '');
        } else $notaFinal = 0;

        $classificacoes = AgClassificacao::query()
            ->get()
            ->pluck('AG_CLASSIFICACAO')
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
                                     AND A.SEMESTRE = ? 
                                     GROUP BY A.AG_QUESTAO, B.QUESTAO, A.AG_CLASSIFICACAO, A.CLASSIFICACAO,COMENTARIO,RESPOSTA,  B.QUESTAO,PORCENTAGEM
                                     ORDER BY A.AG_CLASSIFICACAO ASC 
                                          ",  [$id, $ano, $semestre]);
        //dd(collect($gerentePercepcao)->pluck('PORCENTAGEM')->toArray());

        $gerenteAgrupamentos = [];

        foreach ($gerentePercepcao as $gerentePercepcao) {
            $gerenteAgrupamentos[$gerentePercepcao->CLASSIFICACAO][$gerentePercepcao->QUESTAO][] = $gerentePercepcao->ANALISE;
        }

        //dd($gerenteAgrupamentos);
        $contagem = DB::select("
            		select loja from AG_SUPERVISORES_OBSERVACOES 
        			where loja = ?
        			and DATA_MOVIMENTO BETWEEN ? AND ?  
       
       ", [$id, $dt_ini_obj, $dt_fim_obj]);

        $contagemObservacao = collect($contagem)->pluck('loja')->count();


        $gerenteNome = DB::select("
            select 
            concat(Upper(substring(nome, 1,1)), lower(substring(nome, 2,LEN(nome))), '...') as nome
            from (
            select SUBSTRING(name, 1, 20) as nome 
            from ag_usuarios au 
            where manager  = 'S'
            and store = ?
	) A 
	", [$id]);


        // dd($gerenteNome);
        return view('reportDocCorporate', [
            'cabecalho' => $cabecalho,
            'notaFinal' => $notaFinal,
            'qtd_respostas' => $qtd_respostas,
            'gerenteAgrupamento' => $gerenteAgrupamentos,
            'classificacoes' => $classificacoes,
            'contagemObservacao' => $contagemObservacao,
            'id' => $id,
            'data' => $data,
            'usuario' => $usuarioLogado,
            'gerenteNome' => $gerenteNome
        ]);
    }
}
