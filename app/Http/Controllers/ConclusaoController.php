<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class ConclusaoController extends Controller
{
    /**
     * @return View|Factory
     */
    public function index(): View|Factory
    {
        return view('conclusion');
    }
}
