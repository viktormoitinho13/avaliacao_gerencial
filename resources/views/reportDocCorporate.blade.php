<x-app-layout>

    <div class="container  mx-auto my-auto center-block text-center mt-5">
        <div class="row ">
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 mx-auto my-1 mt-1 center-block">
                <div class="card" style="border-color:#0077ff; height: 75px;">
                    <div class="card-body ">
                        <h5 class="card-title" style="font-size: 15px;">Gerente de loja Avaliado</h5>
                        <p class="card-text" style="font-size: 15px;">
                            <B>{{ $gerenteNome[0]->nome }}</B>
                        </p>
                    </div>
                </div>
            </div>


            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 mx-auto my-1 mt-1 center-block">
                <div class="card" style="border-color:#0077ff; height: 75px;">
                    <div class="card-body ">
                        <h5 class="card-title" style="font-size: 15px;">Quantidade de respostas</h5>
                        <p class="card-text" style="font-size: 15px;">
                            <B>{{ $qtd_respostas[0]->QTD_TOTAL_RESPOSTAS }}</B>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 mx-auto my-1 mt-1 center-block">
                <div class="card " style="border-color:#0077ff;height: 75px;">
                    <div class="card-body ">
                        <h5 class="card-title" style="font-size: 15px;">Nota final da avaliação</h5>
                        <p class="card-text" style="font-size: 15px;"><B>{{ $notaFinal }}</B></p>
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
    <div class="container-fluid mx-auto my-auto center-block mt-5 ">
        @foreach ($gerenteAgrupamento as $titulo => $gerenteAgrupamento)
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-8 col-xxl-6 mx-auto my-3 mt-3">
                <div class="card " style=" border-color:#6B9DD8;">
                    <div class="card-header text-white "
                        style="background-color: #6B9DD8; overflow-wrap:break-word; font-size: 16px;">
                        {{ $titulo }}
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
    @if (auth()->user()->store != '990' and $contagemObservacao < 1 and $data == 1 or $data == 8)
        <div class="container-fluid mx-auto my-auto center-block mt-3 ">
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-8 col-xxl-6 mx-auto ">
                <form action="{{ route('observacao.store', ['id' => $id]) }}" method="POST">
                    @csrf
                    <div class="card  mx-auto mb-1 mt-4 shadow-sm  bg-white rounded "
                        style="background-color:#e3f0ff1a">
                        <div class="card-header text-black "
                            style="background-color: #F6B618; overflow-wrap:break-word; font-size: 16px; ">
                           <b> <i>Observações com o supervisor</i></b>
                            </div>
                        <div class=" d-flex align-items-center justify-content-center">
                            <div style="width: 100%;">


                                <textarea name="observacao" id="observacao" cols="11" rows="10" style="width: 100%;" required></textarea>

                            </div>
                        </div>
                    </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col text-center">

                        <button class="btn btn-lg btn-block col-2 offset-md-3 my-4 mx-auto text-center"
                            style="background-color:#6b9dd8; color:white;"><i class="fas fa-paper-plane"
                                aria-hidden="true"> Enviar </i></button>
                    @else
                        <div class="container mx-auto my-auto center-block mt-3 text-center">
                            <div class="col  mx-auto ">
                                <a class="btn btn-lg btn-block col-3 offset-md-3 my-4 mx-auto text-center"
                                    style="background-color: #F6B618; color:rgb(0, 0, 0); border-color:rgb(255, 255, 255);">
                                    <i  class="fas fa-thumbs-up" aria-hidden="true"></i> Observações realizadas! </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </form>
    @endif
    </div>
    </div>

</x-app-layout>
