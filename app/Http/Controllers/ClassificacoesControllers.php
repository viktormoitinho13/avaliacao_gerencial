<?php

namespace App\Http\Controllers;

use App\Models\AgClassificacao;

class ClassificacoesControllers extends Controller
{
    public function index()
    {
        $classificacoes = AgClassificacao::query()
            ->with('agquestoes')
            ->orderBy('ag_classificacao')
            ->get();

        return view('home', compact('classificacoes'));
    }
    public function show()
    {
    }
}
