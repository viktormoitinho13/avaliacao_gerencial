<x-app-layout>

    <div class="container mx-auto my-auto mt-5 text-center center-block">
        <div class="row ">
             <div class="mx-auto my-1 mt-1 col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 center-block">
               @if ($mes == 2 or $mes == 8)
                     <div class="card" id="card-semestral" >
               @else 
                    <div class="card " id="card-mensal">
               @endif
                      <div class="card-body ">
                        <h5 class="card-title" >Gerente de loja Avaliado</h5>
                        <p class="card-text" >
                             <b>{{ $gerenteNome }}</b>
                        </p>
                    </div>
                </div>

            </div>

             <div class="mx-auto my-1 mt-1 col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 center-block">
               @if ($mes == 2 or $mes == 8)
                     <div class="card" id="card-semestral" >
               @else 
                    <div class="card " id="card-mensal">
               @endif
                      <div class="card-body ">
                        <h5 class="card-title" >Data da avaliação</h5>
                        <p class="card-text" >
                             <b>{{ $mes }} / {{$ano}}</b>
                        </p>
                    </div>
                </div>

            </div>
            <div class="mx-auto my-1 mt-1 col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 center-block">
                  @if ($mes == 2 or $mes == 8)
                    <div class="card" id="card-semestral" >
               @else 
                    <div class="card " id="card-mensal">
               @endif
                    <div class="card-body ">
                        <h5 class="card-title" >Quantidade de respostas</h5>
                        <p class="card-text" >
                            <B>{{ $qtd_respostas[0]->QTD_TOTAL_RESPOSTAS }}</B>
                        </p>
                    </div>
                </div>
            </div>
            <div class="mx-auto my-1 mt-1 col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 center-block">
                 @if ($mes == 2 or $mes == 8)
                  <div class="card" id="card-semestral" >
               @else 
                    <div class="card " id="card-mensal">
               @endif
                    <div class="card-body ">
                        <h5 class="card-title" >Nota final da avaliação</h5>
                        <p class="card-text"><B>{{ $notaFinal }}</B></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto my-auto mt-0 text-center">
        <div class="row ">
   @foreach ($cabecalho as $cabecalho)
    <div class="mt-2 col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 ">
        @if ($mes == 2 or $mes == 8)
            <div class="card" id="card-semestral">
        @else 
            <div class="card" id="card-mensal">
        @endif
            <div class="card-body">
                <h5 class="card-title custom-card-title">{{ $cabecalho->CLASSIFICACAO }}</h5>
               <a href="{{ route('historyClassificacations.index', ['id' => $cabecalho->AG_CLASSIFICACAO, 'gerente' => $gerenteMatricula, 'loja' => $loja]) }}">
                    <p class="card-text"><b>{{ $cabecalho->MEDIA }}</b></p>
                </a>
         </div>
        </div>
    </div>
@endforeach

        </div>
    </div>
    <div class="mx-auto my-auto mt-5 container-fluid center-block ">
        @foreach ($gerenteAgrupamento as $titulo => $gerenteAgrupamento)
            <div class="mx-auto my-3 mt-3 col-12 col-sm-12 col-md-9 col-lg-9 col-xl-8 col-xxl-6">
                  @if ($mes == 2 or $mes == 8)
                    <div class="card " id="card-agrupamento-semestral"  >
                    <div class="text-white card-header " id="card-header-semestral">
                        {{ $titulo }}
                    </div>
               @else 
                    <div class="card " id="card-agrupamento-mensal">
                    <div class="text-white card-header " id="card-header-mensal">
                        {{ $titulo }}
                    </div>
                   
               @endif
                   <div class="card-body ">
                        <ul>
                            @foreach ($gerenteAgrupamento as $questao => $analises)
                                <br />
                                <li>
                                    <p><b>{{ $questao }}</b></p>
                                </li>
                                <ul>
                                    @foreach ($analises as $analise)
                                        <li>
                                            <div class="text-muted"><b>{{ $analise }}</b></div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    </div>
    </div>

</x-app-layout>
