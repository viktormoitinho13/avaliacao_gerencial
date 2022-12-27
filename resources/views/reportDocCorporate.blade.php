<x-app-layout>

    <div class="container  mx-auto my-auto center-block text-center mt-2">
        <div class="row ">
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mx-auto my-1 mt-1 center-block" >
                <div class="card" style="border-color:#6b9dd8; height: 75px;">
                    <div class="card-body ">
                        <h5 class="card-title" style="font-size: 13px;">Quantidade de respostas</h5>
                        <p class="card-text" style="font-size: 12px;">
                            <B>{{ $qtd_respostas[0]->QTD_TOTAL_RESPOSTAS }}</B>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mx-auto my-1 mt-1 center-block">
                <div class="card " style="border-color:#6b9dd8;height: 75px;">
                    <div class="card-body ">
                        <h5 class="card-title" style="font-size: 13px;">Nota final</h5>
                        <p class="card-text" style="font-size: 12px;"><B>{{ $notaFinal }}</B></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-center mt-0 mx-auto my-auto">
        <div class="row ">
            @foreach ($cabecalho as $cabecalho)
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mt-2 ">
                    <div class="card " style="border-color:#6b9dd8;height: 75px;">
                        <div class="card-body ">
                            <h5 class="card-title" style="font-size: 9px;">{{ $cabecalho->CLASSIFICACAO }}</h5>
                            <p class="card-text" style="font-size: 12px;"><B>{{ $cabecalho->MEDIA }}</B></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container-fluid mx-auto my-auto center-block ">
        @foreach ($gerenteAgrupamento as $titulo => $gerenteAgrupamento)
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-8 col-xxl-8 mx-auto my-3 mt-3">
                <div class="card " style=" border-color:#6B9DD8;">
                    <div class="card-body">
                        <h4 class="card-title " style="font-size: 15px;">{{ $titulo }}</h4>
                        @foreach ($gerenteAgrupamento as $conteudo)
                            <p class="card-text mt-1"><small class="text-muted" ><b>{{ $conteudo[0] }}</b></small></p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
