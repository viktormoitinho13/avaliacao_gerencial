<?php

namespace App\Http\Controllers;

use App\Models\AgClassificacao;
use App\Models\AgFormRespostas;
use App\Models\AgQuestoes;
use App\Models\AgStatus;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RespostasQuestoes extends Controller
{
    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function store(Request $request, int $id)
    {

        $usuarioLogado = auth()->user();
        $data_atual = date('m/Y');
        $classificacoesQuestoes = AgQuestoes::query()
            ->get()->pluck('AG_CLASSIFICACAO')->toArray();

        $classificacoes = AgClassificacao::query()
            ->with('agquestoes')
            ->orderBy('ag_classificacao')
            ->whereIn('AG_CLASSIFICACAO', $classificacoesQuestoes)
            ->get()
            ->pluck('AG_CLASSIFICACAO')
            ->toArray();

        $proximo = 0;

        try {
            foreach ($request->input('questao') as $questao => $resposta) {
                AgFormRespostas::query()->create([
                    'AG_CLASSIFICACAO' => $id,
                    'AG_RESPOSTA' => $resposta,
                    'AG_QUESTAO' => $questao,
                    'AG_USUARIO' => $usuarioLogado->id,
                    'AG_MATRICULA' => $usuarioLogado->registration,
                    'DATA_RESPOSTAS' => $data_atual,
                    'AG_LOJA' => auth()->user()->store

                ]);
            }
            AgStatus::query()->create([
                'AG_CLASSIFICACAO' => $id,
                'AG_USUARIO' => $usuarioLogado->id,
                'AG_MATRICULA' => $usuarioLogado->registration,
                'AG_DATA' => $data_atual,
            ]);

            //$id é atual

            for ($i = 0; $i <= count($classificacoes); $i++) {

                if ($id >= count($classificacoes)) {
                    return redirect()->route('conclusion');
                }

                if ($id != $i) {
                    continue;
                }

                $proximo = $classificacoes[$i];
            }

            return redirect("/form/$proximo")
                ->withInput()
                ->with(['sucess' => 'Sua resposta foi computada com sucesso.']);
        } catch (QueryException $e) {
            //dd($e);
            if ($id < count($classificacoes)) {
                $id = $id + 1;
                return redirect("/form/$id");
            } else {
                return redirect("/home")
                    // return redirect()->route('relatorio')
                    ->withInput()
                    ->with(['err' => 'Este formulário já foi respondido.']);
            };
        }
    }
}