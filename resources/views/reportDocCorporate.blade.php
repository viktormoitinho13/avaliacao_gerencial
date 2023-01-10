<x-app-layout>

    <div class="container  mx-auto my-auto center-block text-center mt-5">
        <div class="row ">
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mx-auto my-1 mt-1 center-block">
                <div class="card" style="border-color:#6b9dd8; height: 75px;">
                    <div class="card-body ">
                        <h5 class="card-title" style="font-size: 15px;">Quantidade de respostas</h5>
                        <p class="card-text" style="font-size: 15px;">
                            <B>{{ $qtd_respostas[0]->QTD_TOTAL_RESPOSTAS }}</B>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mx-auto my-1 mt-1 center-block">
                <div class="card " style="border-color:#6b9dd8;height: 75px;">
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
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-7 col-xxl-6 mx-auto my-3 mt-1">
                <div class="card " style=" border-color:#6B9DD8;">
                 <div class="card-header text-white " style="background-color: #6B9DD8; overflow-wrap:break-word; font-size: 16px;"><i>{{ $titulo }}</i></div>

                    <div class="card-body">
                       
                        @foreach ($gerenteAgrupamento as $conteudo)
                                    <ul>
                                          <li> <p class="card-text mt-3"style="font-size: 17px;"><small
                                            class="text-muted"><b>{{ $conteudo[0] }}</b></small></p></li>
                                            <ul>
                                              <li> <p class="card-text mt-3"style="font-size: 16px;"><small
                                            class="text-muted">{{ $conteudo[1] }}</small></p></li>
                                            </ul>
                                        
                                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
     <div class="container-fluid mx-auto my-auto center-block mt-3 ">
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-7 col-xxl-6 mx-auto ">
              

    <form action="{{ route('observacao.store', ['id' => $id]) }}" method="POST">
            @csrf
            <div class="card  mx-auto mb-1 mt-4 shadow-sm  bg-white rounded " style="border-color: #b1d5ff; background-color:#e3f0ff1a">
                  <div class="card-header text-white " style="background-color: #6B9DD8; overflow-wrap:break-word; font-size: 16px;">Observações com o supervisor</div>
                <div class=" d-flex align-items-center justify-content-center">
                    <div style="width: 100%;">
                     @if($contagemObservacao < 1 and $data == 1 or $data == 8)
                        <textarea name="observacao" id="observacao" cols="11" rows="6" style="width: 100%;" required></textarea>
                    @else 
                        <textarea disabled name="observacao" id="observacao" cols="11" rows="6" style="width: 100%;">..... Já foi realizada uma observação neste relatório! </textarea>
                    @endif 
                    </div>
                </div>
            </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                @if($contagemObservacao < 1 and $data == 1 or $data == 8)
                <button class="btn btn-lg btn-block col-4 offset-md-3 my-4 mx-auto text-center"
                    style="background-color:#6b9dd8; color:white;"><i class="fas fa-paper-plane"
                        aria-hidden="true">  Enviar </i></button>
                @else 
                
                      <a class="btn btn-lg btn-block col-4 offset-md-3 my-4 mx-auto text-center"
                       style="background-color: #F6B618; color:rgb(0, 0, 0); border-color:rgb(255, 255, 255);"><i
                       class="fas fa-thumbs-up" aria-hidden="true"></i> Observações já realizadas! </a>
                @endif
            </div>
        </div>
    </div>
    </form>
   </div>
    </div>

</x-app-layout>






