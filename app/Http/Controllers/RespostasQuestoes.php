<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgFormRespostas;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;

class RespostasQuestoes extends Controller
{
    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function store(Request $request, int $id): RedirectResponse
    {
        $usuarioLogado = auth()->user();

        try {
            foreach ($request->input('questao') as $questao => $resposta) {
                AgFormRespostas::query()->create([
                    'AG_CLASSIFICACAO' => $id,
                    'AG_RESPOSTA' => $resposta,
                    'AG_QUESTAO' => $questao,
                    'AG_USUARIO' => $usuarioLogado->id,
                    'AG_MATRICULA' => $usuarioLogado->registration,
                ]);
            }

            return redirect()->route('home');
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->with(['err' => 'Não possível gravar as informações']);
        }
    }
}
