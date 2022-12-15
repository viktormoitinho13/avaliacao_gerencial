<x-app-layout>

    <div class="container text-center mt-2 mx-auto my-auto">
        <div class="row ">
           
            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-2 col-xxl-2 mt-1 ">
                <div class="card" style="border-color:#6b9dd8; height: 75px;">
                    <div class="card-body ">
                        <h5 class="card-title" style="font-size: 9px;">Quantidade de respostas</h5>
                        <p class="card-text" style="font-size: 12px;" ><B>{{ $qtd_respostas[0]->QTD_TOTAL_RESPOSTAS }}</B></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-2 col-xxl-2 mt-1 ">
                <div class="card " style="border-color:#6b9dd8;height: 75px;">
                    <div class="card-body ">
                        <h5 class="card-title" style="font-size: 9px;">Nota final</h5>
                        <p class="card-text" style="font-size: 12px;"><B>{{ $notaFinal }}</B></p>
                    </div>
                </div>
            </div>
        @foreach ($cabecalho as $cabecalho)
        <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-2 col-xxl-2 mt-1 ">
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
            <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 col-xxl-7 mx-auto my-3 mt-3">
                <div class="card " style=" border-color:#6B9DD8;">
                    <div class="card-body">
                        <h4 class="card-title ">{{ $titulo }}</h4>
                        @foreach ($gerenteAgrupamento as $conteudo)
                            <p class="card-text mt-1"><small class="text-muted"><b>{{ $conteudo }}</b></small></p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
