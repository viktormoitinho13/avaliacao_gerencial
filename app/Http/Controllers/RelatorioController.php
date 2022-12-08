<?php

namespace App\Http\Controllers;

use App\Models\AgFormRespostas;


class RelatorioController extends Controller
{
    public function index()
    {
        $teste = AgFormRespostas::query()
            ->get();

        //dd($teste);
        return view('report', [
            'teste' => $teste
        ]);
    }
}