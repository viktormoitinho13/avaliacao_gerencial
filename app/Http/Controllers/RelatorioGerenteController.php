<?php

namespace App\Http\Controllers;

use App\Models\AgFormRespostas;
use Illuminate\Support\Facades\DB;

class RelatorioGerenteController extends Controller
{
    public function index()
    {


        $data = date('m/Y');
        $results = DB::select(
            '
                     SELECT DISTINCT ag_loja
                     from AG_FORM_RESPOSTAS afr 
                     where ag_loja in 
                     (
                        select store from ag_usuarios 
                        where registration = ?)',
            [auth()->user()->registration]
        );
        $contagem = collect($results)->pluck('ag_loja')->count();
        //      dd(collect($results));

        return view('report', [
            'results' => $results,
            'contagem' => $contagem,
            'data' => $data
        ]);
    }
}