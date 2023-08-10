<?php

namespace App\Http\Middleware;

use App\Models\AgClassificacao;
use App\Models\AgStatus;
use Closure;
use Illuminate\Http\Request;

class ValidarClassificacoes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
    }
}
