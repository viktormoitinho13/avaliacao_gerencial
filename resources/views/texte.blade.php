 <div class="container-fluid d-flex justify-content-center mt-1 mx-auto my-auto">
        <div class="row">
            @foreach ($cabecalho as $cabecalho)
                <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 mt-2 ">
                    <div class="card text-center " style="border-color: #6b9dd8">
                        <div class="card-body ">
                            <h5 class="card-title" style="font-size: 10px;">{{ $cabecalho->CLASSIFICACAO }}</h5>
                            <p class="card-text"><b>{{ $cabecalho->MEDIA }}</b></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
   



  <div class="card" style="border-color:#6b9dd8;">
                    <div class="card-body  ">
                        <h5 class="card-title" style="font-size: 15px;">Quantidade de respostas</h5>
                        <p class="card-text"><B>{{ $qtd_respostas[0]->QTD_TOTAL_RESPOSTAS }}</B></p>
                    </div>
                </div>
            </div>
             <div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 mt-2">
                <div class="card" style="border-color:#6b9dd8;">
                    <div class="card-body">
                        <h5 class="card-title"style="font-size: 15px;">Nota final</h5>
                        <p class="card-text"><b>{{ $notaFinal }}</b></p>
                    </div>
                </div>
                </div>



    <div class="container-fluid mt-3 ">
            <div class="row">
            @foreach ($cabecalho as $cabecalho)
                <div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 mt-2 ">
                    <div class="card text-center " style="border-color: #6b9dd8">
                        <div class="card-body ">
                            <h5 class="card-title" style="font-size: 10px;">{{ $cabecalho->CLASSIFICACAO }}</h5>
                            <p class="card-text"><b>{{ $cabecalho->MEDIA }}</b></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </div>






















    <div class="container-fluid d-flex justify-content-center mt-3 mx-auto my-auto">
        <div class="row ">
            <div class="col-sm-3 ">
                <div class="card">
                    <div class="card-body ">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>












    <div class="container-fluid mt-3 ">
            <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                <div class="card" style="border-color:#6b9dd8;">
                    <div class="card-body  ">
                        <h5 class="card-title" style="font-size: 15px;">Quantidade de respostas</h5>
                        <p class="card-text"><B>{{ $qtd_respostas[0]->QTD_TOTAL_RESPOSTAS }}</B></p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 mt-2">
                <div class="card" style="border-color:#6b9dd8;">
                    <div class="card-body">
                        <h5 class="card-title"style="font-size: 15px;">Nota final</h5>
                        <p class="card-text"><b>{{ $notaFinal }}</b></p>
                    </div>
                </div>
        </div>
    </div>