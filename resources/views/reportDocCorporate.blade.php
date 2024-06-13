<x-app-layout>
    <div class="container mx-auto my-auto mt-5 text-center center-block">
        <div class="row ">
            <div class="mx-auto my-1 mt-1 col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 center-block">
                <div class="card" style="border-color:#0077ff; height: 75px;">
                    <div class="card-body ">
                        <h5 class="card-title" style="font-size: 15px;">Gerente de loja Avaliado</h5>
                        <p class="card-text" style="font-size: 15px;">
                            <b>{{$gerenteNome[0]->nome}}</b>
                        </p>
                    </div>
                </div>
            </div>
            <div class="mx-auto my-1 mt-1 col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 center-block">
                <div class="card" style="border-color:#0077ff; height: 75px;">
                    <div class="card-body ">
                        <h5 class="card-title" style="font-size: 15px;">Quantidade de respostas</h5>
                        <p class="card-text" style="font-size: 15px;">
                            <b>{{ $qtd_respostas }}</b>
                        </p>
                    </div>
                </div>
            </div>
            <div class="mx-auto my-1 mt-1 col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 center-block">
                <div class="card " style="border-color:#0077ff;height: 75px;">
                    <div class="card-body ">
                        <h5 class="card-title" style="font-size: 15px;">Nota final da avaliação</h5>
                        <p class="card-text" style="font-size: 15px;"><B>{{ $notaFinal }}</B></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto my-auto mt-0 text-center">
        <div class="row ">
            @foreach ($cabecalho as $cabecalho)
                <div class="mt-2 col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 ">
                    <div class="card " style="border-color:#6b9dd8;height: 75px;">
                        <div class="card-body ">
                            <h5 class="card-title" style="font-size: 9px;">{{ $cabecalho->CLASSIFICACAO }}</h5>
                                <p class="card-text" style="font-size: 12px;">
                                    <b>{{ $cabecalho->MEDIA }}</b>
                                </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mx-auto my-auto mt-5 container-fluid center-block ">
        @foreach ($gerenteAgrupamento as $titulo => $gerenteAgrupamento)
            <div class="mx-auto my-3 mt-3 col-12 col-sm-12 col-md-9 col-lg-9 col-xl-8 col-xxl-6">
                <div class="card " style=" border-color:#6B9DD8;">
                    <div class="text-white card-header "
                        style="background-color: #6B9DD8; overflow-wrap:break-word; font-size: 16px;">
                        {{$titulo}}
                    </div>
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
