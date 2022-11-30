<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgClassificacao;
use Illuminate\Support\Facades\DB;


class ClassificacoesControllers extends Controller
{
    public function index()
{       
    $classificacoes = AgClassificacao::query()->orderBy('ag_classificacao')->get();
    //dd($classificacoes);
    return view('home', compact('classificacoes'));
}
    public function show()
{
}
}
