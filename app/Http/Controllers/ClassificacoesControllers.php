<?php

namespace App\Http\Controllers;

use App\Models\AgClassificacao;
use App\Models\AgQuestoes;
use App\Models\AgStatus;
use App\Models\AgVendedor;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ClassificacoesControllers extends Controller
{
    public function index()
    {

        $data = date('m');
        $dataRespostas = date('m/y');

        $usuarioLogado = auth()->user();
      
        $classificacoesQuestoes = AgQuestoes::query()
            ->get()->pluck('AG_CLASSIFICACAO')->toArray();

        $gerenteRegistration = DB::select('
                                select A.GERENTE_ATUAL  from GERENTES_LOJAS A
		                        join 
                                (
		            			select LOJA , max(movimento) AS MOVIMENTO  from GERENTES_LOJAS gl
				                group by LOJA
			                    ) B ON A.LOJA = B.LOJA AND A.MOVIMENTO = B.MOVIMENTO
			                    WHERE A.LOJA = ?', [auth()->user()->store]);

        // dd(collect($gerenteRegistration)->pluck('GERENTE_ATUAL')->toArray());
        $gerenteNome = AgVendedor::query()
            ->where('VENDEDOR', '=', collect($gerenteRegistration)->pluck('GERENTE_ATUAL')->toArray())
            ->get();

        $classificacoes = AgClassificacao::query()
            ->with('agquestoes')
            ->orderBy('ag_classificacao')
            ->whereIn('AG_CLASSIFICACAO', $classificacoesQuestoes)
            ->take(1)->get();

          //  DD($classificacoes);

        $contarStatus = AgStatus::query()
            ->distinct()
            ->select('AG_CLASSIFICACAO')
            ->where('AG_MATRICULA', '=', $usuarioLogado->registration)
            ->get()->count('AG_CLASSIFICACAO');

        $contarQuestoes = AgQuestoes::query()
            ->distinct()
            ->select('AG_CLASSIFICACAO')
            ->get()->count('AG_CLASSIFICACAO');

        $resultado = DB::select(
            '
                     SELECT DISTINCT ag_loja
                     from AG_FORM_RESPOSTAS afr
                     where ag_loja in
                     (
                        select store from ag_usuarios
                        where registration = ?)',
            [auth()->user()->registration]
        );

        $resultadoManager = DB::select(
            "
                      SELECT DISTINCT ag_loja
                     from AG_FORM_RESPOSTAS afr
                     where ag_loja in
                     (
                        select store from ag_usuarios
                     )",
        );
        
         $resultadoSupervisor = DB::select(
            "
                        SELECT DISTINCT ag_loja
                     from AG_FORM_RESPOSTAS afr
                     where ag_loja in
                     (
                   		select store from ag_usuarios au 
                   		where au.registration = ?
                     )
           ", [$usuarioLogado->registration]);
        
        
        $contagem = collect($resultado)->pluck('ag_loja')->count();

        return view('home', [
            'classificacoes' => $classificacoes,
            'gerenteNome' => $gerenteNome,
            'contarStatus' => $contarStatus,
            'contarQuestoes' => $contarQuestoes,
            'contagem' => $contagem,
            'resultado' => $resultado,
            'data' => $data,
            'resultadoManager' => $resultadoManager,
            'dataRespostas' => $dataRespostas,
            'resultadoSupervisor' => $resultadoSupervisor

        ]);
    }
    public function show()
    {
    }
}
