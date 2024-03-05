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

class RespostasQuestoes extends Controller
{
    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function store(Request $request, int $id)
    {
        $usuarioLogado = Auth::user();

        $classificacoes = AgClassificacao::query()
            ->get()
            ->pluck('AG_CLASSIFICACAO')
            ->toArray();

        $controlador = 1;

        try {
            if (!in_array($id, $classificacoes)) {
                return redirect()->route('home');
            }

            $this->salvaFormularioRepostas($request, $usuarioLogado, $id);

            $this->salvaStatus($usuarioLogado, $id);

            for ($i = 1; $i < count($classificacoes); $i++) {

                if ($id >= count($classificacoes)) {
                    return redirect()->route('conclusion');
                }

                if ($id != $i) {
                    continue;
                }

                $controlador = $classificacoes[$id];
            }

            return redirect()->route('questions.index', $controlador);
        } catch (QueryException $e) {
            logger('Error', ['message' => $e->getMessage()]);

            return redirect()->route('questions.index', $controlador + 1);
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

        foreach ($questoes as $questao => $resposta) {
            AgFormRespostas::query()->create([
                'AG_CLASSIFICACAO' => $id,
                'AG_RESPOSTA' => $resposta,
                'AG_QUESTAO' => $questao,
                'AG_USUARIO' => $usuarioLogado->id,
                'AG_MATRICULA' => $usuarioLogado->registration,
                'DATA_RESPOSTAS' => date('m/Y'),
                'DATA_RESPOSTA_COMPLETA' => date('d/m/Y')   ,
                'AG_LOJA' => $usuarioLogado->store,
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
        ]);
    }
}
