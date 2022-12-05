<?php

namespace App\Http\Controllers;

use App\Models\AgFormRespostas;
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
    public function store(Request $request, int $id): RedirectResponse
    {
        $usuarioLogado = auth()->user();
        $data_atual = Carbon::now()->format('m/Y');
        //dd($data_atual);

        try {
            foreach ($request->input('questao') as $questao => $resposta) {
                AgFormRespostas::query()->create([
                    'AG_CLASSIFICACAO' => $id,
                    'AG_RESPOSTA' => $resposta,
                    'AG_QUESTAO' => $questao,
                    'AG_USUARIO' => $usuarioLogado->id,
                    'AG_MATRICULA' => $usuarioLogado->registration,
                    'DATA_RESPOSTAS' => $data_atual,
                ]);
            }

            AgStatus::query()->create([
                'AG_CLASSIFICACAO' => $id,
                'AG_USUARIO' => $usuarioLogado->id,
                'AG_MATRICULA' => $usuarioLogado->registration,
                'AG_DATA' => $data_atual,
            ]);
            return redirect()->route('home')
                ->withInput()
                ->with(['sucess' => 'Sua resposta foi computada com sucesso.']);
        } catch (QueryException $e) {
            return redirect()->route('home')
                ->withInput()
                ->with(['err' => 'Este formulário já foi respondido.']);

        }
    }

}
