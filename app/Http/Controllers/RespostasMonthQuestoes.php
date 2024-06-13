<?php

namespace App\Http\Controllers;

use App\Models\AgClassificacao;
use App\Models\AgFormRespostas;
use App\Models\AgStatus;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AgGerente;
use DateTime;

class RespostasMonthQuestoes extends Controller
{
    public function store(Request $request, int $id)
    {
        $ano = date('Y');
        $mesAtual = date('m');
        $mes = $mesAtual < 8 ? 2 : 8;
        $dataPadrao = new DateTime("$ano-$mes-01");
        $dataPadrao->modify('last day of this month');
        $dataLimite = $dataPadrao->format('d-m-Y');
        $usuarioLogado = Auth::user();

        $classificacoes = AgClassificacao::query()
            ->join('AG_LIBERACAO_QUESTOES_MENSAIS', function ($join) {
                $join->on('AG_CLASSIFICACAO.AG_CLASSIFICACAO', '=', 'AG_LIBERACAO_QUESTOES_MENSAIS.ID_CLASSIFICACAO');
            })
            ->orderBy('AG_CLASSIFICACAO') // Adiciona a ordenação aqui
            ->pluck('AG_CLASSIFICACAO') // Pluck após a ordenação
            ->toArray();

        //  dd($classificacoes);

        $this->salvaFormularioRepostas($request, $usuarioLogado, $id);
        $this->salvaStatus($usuarioLogado, $id);

        // Obter as classificações respondidas

        $classificacoesRespondidas = AgClassificacao::query()
            ->join('AG_LIBERACAO_QUESTOES_MENSAIS', function ($join) {
                $join->on('AG_CLASSIFICACAO.AG_CLASSIFICACAO', '=', 'AG_LIBERACAO_QUESTOES_MENSAIS.ID_CLASSIFICACAO');
            })
            ->leftJoin('AG_STATUS', function ($join) {
                $join->on('AG_LIBERACAO_QUESTOES_MENSAIS.ID_CLASSIFICACAO', '=', 'AG_STATUS.AG_CLASSIFICACAO')
                    ->on('AG_LIBERACAO_QUESTOES_MENSAIS.LOJA', '=', 'AG_STATUS.AG_LOJA');
            })
            ->where('AG_STATUS.AG_LOJA', $usuarioLogado->store)
            ->where('AG_STATUS.AG_MATRICULA', $usuarioLogado->registration)
            ->where('AG_STATUS.DATA_RESPOSTA_COMPLETA', '>', $dataLimite)
            ->whereMonth('AG_STATUS.DATA_RESPOSTA_COMPLETA', '=', $mesAtual)
            ->whereYear('AG_STATUS.DATA_RESPOSTA_COMPLETA', '=', $ano)
            ->orderBy('AG_CLASSIFICACAO.AG_CLASSIFICACAO')
            ->pluck('AG_CLASSIFICACAO.AG_CLASSIFICACAO')
            ->toArray(); // Converter para array

        // Remover valores duplicados
        $classificacoes = array_diff($classificacoes, $classificacoesRespondidas);

        // Se você precisar da coleção resultante como uma Collection do Laravel
        $classificacoes = collect($classificacoes)->toArray();;

        if (empty($classificacoes) || min($classificacoes) === null) {
            return redirect()->route('conclusion');
        }

        $controlador = min($classificacoes);


        try {






            return redirect()->route('questionsMonth.index', $controlador);
        } catch (QueryException $e) {
            logger('Error', ['message' => $e->getMessage()]);
            return redirect()->route('questionsMonth.index', $controlador);
        }
    }

    /**
     * @param Request $request
     * @param User $usuarioLogado
     * @param integer $id
     * @return void
     */
    private function salvaFormularioRepostas(Request $request, User $usuarioLogado, int $id): void
    {
        $questoes = $request->input('questao', []);

        $gerente = AgGerente::query()
            ->select('GERENTE_ATUAL', 'NOME')
            ->whereNull('DATA_SAIDA')
            ->where('LOJA', '=', $usuarioLogado->store)
            ->get();


        foreach ($questoes as $questao => $resposta) {
            AgFormRespostas::query()->create([
                'AG_CLASSIFICACAO' => $id,
                'AG_RESPOSTA' => $resposta,
                'AG_QUESTAO' => $questao,
                'AG_USUARIO' => $usuarioLogado->id,
                'AG_MATRICULA' => $usuarioLogado->registration,
                'DATA_RESPOSTAS' => date('m/Y'),
                'DATA_RESPOSTA_COMPLETA' => date('d/m/Y'),
                'AG_LOJA' => $usuarioLogado->store,
                'GERENTE' => $gerente->first()->GERENTE_ATUAL,
                'NOME_GERENTE' => $gerente->first()->NOME
            ]);
        }
    }

    /**
     * @param User $usuarioLogado
     * @param integer $id
     * @return void
     */
    private function salvaStatus(User $usuarioLogado, int $id): void
    {
        AgStatus::query()->create([
            'AG_CLASSIFICACAO' => $id,
            'AG_USUARIO' => $usuarioLogado->id,
            'AG_MATRICULA' => $usuarioLogado->registration,
            'AG_DATA' => date('m/Y'),
            'DATA_RESPOSTA_COMPLETA' => date('d/m/Y'),
            'AG_LOJA' => $usuarioLogado->store
        ]);
    }
}
