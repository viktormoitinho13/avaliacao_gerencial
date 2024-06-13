<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgClassificacao;
use App\Models\AgFormRespostas;
use App\Models\AgGerente;
use App\Models\AgQuestoes;
use App\Models\AgStatus;
use App\Models\AgVendedor;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RelatorioMensalController extends Controller
{
    public function index(Request $request)
    {
        $mes = $request->input('mes');
        $ano = $request->input('ano');
        $usuarioLogado = auth()->user();

        // dd($usuarioLogado);


        if ($mes == null or $ano == null) {
            //$dataConcatenada = sprintf('01-%02d-%04d', $mesAtual, $anoAtual);
            $mes = date('m') < 8 ? 2 : 8;
            $ano = date('Y');
            $dataPadrao = '01' . '/' . $mes . '/' . $ano;
        } else {
            $dataPadrao = '01' . '/' . $mes . '/' . $ano;
        }
        if ($usuarioLogado->supervisor == 'S') {
            $resultadoManager = AgFormRespostas::query()
                ->leftJoin('vw_historico_gerentes', function ($join) {
                    $join->on('AG_FORM_RESPOSTAS.AG_LOJA', '=', 'vw_historico_gerentes.LOJA');
                })
                ->select(DB::raw("AG_FORM_RESPOSTAS.AG_LOJA as loja"), DB::raw("CONCAT(UPPER(SUBSTRING(AG_FORM_RESPOSTAS.NOME_GERENTE, 1, 1)), LOWER(SUBSTRING(AG_FORM_RESPOSTAS.NOME_GERENTE, 2, 15)), '.') AS nome"))
                ->where('vw_historico_gerentes.SUPERVISOR', $usuarioLogado->registration)
                ->whereYear('AG_FORM_RESPOSTAS.DATA_RESPOSTA_COMPLETA', $ano)
                ->whereMonth('AG_FORM_RESPOSTAS.DATA_RESPOSTA_COMPLETA', $mes)
                ->whereNull('vw_historico_gerentes.DATA_SAIDA')
                ->orderBy('AG_FORM_RESPOSTAS.AG_LOJA', 'asc')
                ->distinct();
        } else {
            $resultadoManager = AgFormRespostas::query()
                ->leftJoin('vw_historico_gerentes', function ($join) {
                    $join->on('AG_FORM_RESPOSTAS.AG_LOJA', '=', 'vw_historico_gerentes.LOJA');
                })
                ->select(DB::raw("AG_FORM_RESPOSTAS.AG_LOJA as loja"), DB::raw("CONCAT(UPPER(SUBSTRING(AG_FORM_RESPOSTAS.NOME_GERENTE, 1, 1)), LOWER(SUBSTRING(AG_FORM_RESPOSTAS.NOME_GERENTE, 2, 15)), '.') AS nome"))
                ->whereYear('AG_FORM_RESPOSTAS.DATA_RESPOSTA_COMPLETA', $ano)
                ->whereMonth('AG_FORM_RESPOSTAS.DATA_RESPOSTA_COMPLETA', $mes)
                ->whereNull('vw_historico_gerentes.DATA_SAIDA')
                ->orderBy('AG_FORM_RESPOSTAS.AG_LOJA', 'asc')
                ->distinct();
        }

        $id = $_GET['loja'] ?? null;
        if ($id != null) {
            $resultadoManager = $resultadoManager->where('AG_FORM_RESPOSTAS.AG_LOJA', $id);
        }

        $resultadoManager = $resultadoManager->paginate(10);


        return view('listReportMonth', [
            'resultadoManager' => $resultadoManager,
            'mes' => $mes,
            'ano' => $ano
        ]);
    }
}
