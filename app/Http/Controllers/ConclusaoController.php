<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConclusaoController extends Controller
{
    public function index()
    {
        return view('conclusion');
    }
}