<?php

namespace App\Http\Controllers;

use App\Models\AgClassificacao;
use App\Models\AgQuestoes;
use Illuminate\Support\Facades\DB;
use DateTime;

class ClassificacoesControllers extends Controller
{
    public function index()
    {
        $usuarioLogado = auth()->user();
        $mesAtual = date('m');
        $ano = date('Y');
        $mes = date('m') < 8 ? 2 : 8;
        $dataPadrao = new DateTime("$ano-$mes-01");
        $dataPadrao->modify('last day of this month');

        // Inicializando variáveis padrão
        $classificacoes = collect();
        $classificacoesMensais = null;
        $gerenteNome = collect();
        $ativo = null;
        $questoesMensaisstatus = 'N';

        if ($usuarioLogado->manager == 'N' and $usuarioLogado->supervisor == 'N') {
            $classificacoesQuestoes = AgQuestoes::query()
                ->get()->pluck('AG_CLASSIFICACAO')->toArray();

            $gerenteNome = DB::SELECT("
                select name AS NOME
                from ag_usuarios au 
                where au.store = ? 
                and au.manager = 'S'
            ", [auth()->user()->store]);

            $ativo = AgClassificacao::query()
                ->leftJoin('AG_STATUS', function ($join) {
                    $join->on('AG_CLASSIFICACAO.AG_CLASSIFICACAO', '=', 'AG_STATUS.AG_CLASSIFICACAO');
                })
                ->select(DB::raw("CASE 
                    WHEN COUNT(DISTINCT AG_CLASSIFICACAO.AG_CLASSIFICACAO) = 0 OR COUNT(DISTINCT AG_STATUS.AG_CLASSIFICACAO) = 0 
                    THEN 'X'
                    WHEN COUNT(DISTINCT AG_STATUS.AG_CLASSIFICACAO) = COUNT(DISTINCT AG_CLASSIFICACAO.AG_CLASSIFICACAO) 
                    THEN 'S'
                    ELSE 'N'
                END AS STATUS"))
                ->where('AG_STATUS.AG_MATRICULA', $usuarioLogado->registration)
                ->whereMonth('AG_STATUS.DATA_RESPOSTA_COMPLETA', $mes)
                ->whereYear('AG_STATUS.DATA_RESPOSTA_COMPLETA', $ano)
                ->first();

            $classificacoes = AgClassificacao::query()
                ->with('agquestoes')
                ->orderBy('ag_classificacao')
                ->whereIn('AG_CLASSIFICACAO', $classificacoesQuestoes)
                ->take(1)->get();

            $classificacoesMensais = DB::table('AG_LIBERACAO_QUESTOES_MENSAIS AS A')
                ->selectRaw('MIN(A.ID_CLASSIFICACAO) AS ID_CLASSIFICACAO')
                ->where('A.LOJA', $usuarioLogado->store)
                ->where('A.DATA_LIMITE_RESPOSTA', '>', $dataPadrao)
                ->whereNotExists(function ($query) use ($usuarioLogado, $dataPadrao, $mesAtual, $ano) {
                    $query->select(DB::raw(1))
                        ->from('AG_STATUS AS B')
                        ->where('B.AG_MATRICULA', $usuarioLogado->registration)
                        ->where('B.AG_LOJA', $usuarioLogado->store)
                        ->where('B.DATA_RESPOSTA_COMPLETA', '>', $dataPadrao)
                        ->whereRaw('MONTH(B.DATA_RESPOSTA_COMPLETA) = ?', [$mesAtual])
                        ->whereRaw('YEAR(B.DATA_RESPOSTA_COMPLETA) = ?', [$ano])
                        ->whereRaw('A.ID_CLASSIFICACAO = B.AG_CLASSIFICACAO');
                })
                ->first();

            $questoesMensaisstatus = $classificacoesMensais->ID_CLASSIFICACAO !== null ? 'S' : 'N';
        }

        return view('home', [
            'classificacoes' => $classificacoes,
            'classificacoesMensais' => $classificacoesMensais,
            'gerenteNome' => $gerenteNome,
            'ativo' => $ativo,
            'questoesMensaisstatus' => $questoesMensaisstatus,
            'mes' => $mes
        ]);
    }
}
