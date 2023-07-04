<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgFormRespostas;
use App\Models\AgSupervisorObservacao;
use Illuminate\Support\Facades\DB;
use App\Models\AgQuestoes;
use App\Models\AgClassificacao;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\QueryException;

class SupervisorObservacaoController extends Controller
{
    public function store(Request $request, int $id)
    {
        $usuarioLogado = auth()->user();
        $data_atual = date('d/m/Y');
        $observacao = $request->input('observacao'); // Usar como teste, necessário tratar os dados
        $data_avaliacao = null;

        if (date('m') <= 8) {
            $data_avaliacao =  '02/' . date('Y');
        } else $data_avaliacao = '08/' . date('Y');

        $data_avaliacao = strval($data_avaliacao);

        try {
            AgSupervisorObservacao::query()->create([
                'DATA_MOVIMENTO' => $data_atual,
                'LOJA' => $id,
                'USUARIO' => $usuarioLogado->registration,
                'OBSERVACAO' => $observacao,
                'AVALIACAO_DATA' => $data_avaliacao

            ]);

            return redirect("/home");
        } catch (\Throwable $th) {
            return redirect("/home")
                // return redirect()->route('relatorio')
                ->withInput()
                ->with(['err' => 'Este formulário já foi respondido.']);
        }
    }
}