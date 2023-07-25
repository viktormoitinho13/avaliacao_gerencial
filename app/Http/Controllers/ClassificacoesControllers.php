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
        //  DD($usuarioLogado);
        $classificacoesQuestoes = AgQuestoes::query()
            ->get()->pluck('AG_CLASSIFICACAO')->toArray();

        $gerenteRegistration = DB::select('
                               
	                            select A.GERENTE_ATUAL from GERENTES_LOJAS A
		                        join 
                                (
		            			select LOJA , max(movimento) AS MOVIMENTO  from GERENTES_LOJAS gl
		            			WHERE LOJA = ?
				                group by LOJA
			                    ) B ON A.LOJA = B.LOJA AND A.MOVIMENTO = B.MOVIMENTO
                            ', [auth()->user()->store]);

        // dd($usuarioLogado);
        // dd(collect($gerenteRegistration)->pluck('GERENTE_ATUAL')->toArray());
        $gerenteNome = DB::SELECT("
            select 
            name AS NOME
            from ag_usuarios au 
            where au.store = ? 
            and au.manager = 'S'
         ", [auth()->user()->store]);


        // DD($gerenteNome);
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
            "      
                    
                     SELECT DISTINCT 
                     STORE AS ag_loja,
                     CONCAT(UPPER(SUBSTRING(au.name, 1, 1)), LOWER(SUBSTRING(au.name, 2, 15)), '.') AS name
                     FROM ag_usuarios au WITH(NOLOCK)
                     WHERE AU.registration = ?
                     AND AU.MANAGER = 'N'
                     AND AU.supervisor = 'S'
            " ,
            [auth()->user()->registration]
        );


          $id = $_GET['loja'] ?? null ;
          if($id != null){
            $resultado = array_filter($resultado, fn($item) => $item->ag_loja == $id);
           }

      

        $resultadoManager = DB::select(
            "
                     select DISTINCT 
                     store as ag_loja ,
                     CONCAT(UPPER(SUBSTRING(au.name, 1, 1)), LOWER(SUBSTRING(au.name, 2, 15)), '.') AS name
                     from ag_usuarios au with(nolock)
                     join lojas b with(nolock) on au.store = b.LOJA 
                     where au.manager = 'S'
                     and au.supervisor = 'N'
                     and b.LOJA < 100    

            ",
        );

           $id = $_GET['loja'] ?? null ;
          if($id != null){
            $resultadoManager = array_filter($resultadoManager, fn($item) => $item->ag_loja == $id);
           }
        
        $LojasGerentes = DB::select( ' 
                        select DISTINCT store from ag_usuarios au 
                   		where au.registration = ?', [auth()->user()->registration]);

        //dd($LojasGerentes)       ;

        $contagemLojas = DB::select( ' 
                        select DISTINCT store from ag_usuarios au 
                   		where au.registration = ?', [auth()->user()->registration]);

        
        $contagem = collect($resultado)->pluck('ag_loja')->count();

        $contagemLojas = collect($contagemLojas)->pluck('store')->count();

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
            'resultadoSupervisor' => $resultado,
            'contagemLojas' => $contagemLojas,
            'LojasGerentes' => $LojasGerentes

        ]);
    }
  
}