<x-app-layout>

<div class="container mt-2 ">
<div class="row d-flex justify-content-center text-center" >
  <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-md-offset-1">
    <div class="card" style="border-color:#6b9dd8;">
      <div class="card-body">
        <h5 class="card-title">Quantidade de respostas</h5>
        <p class="card-text"><B>{{ $qtd_respostas[0]->QTD_TOTAL_RESPOSTAS }}</B></p>
      
      </div>
    </div>
  </div>
  <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
    <div class="card" style="border-color:#6b9dd8;">
      <div class="card-body">
        <h5 class="card-title">Nota final</h5>
        <p class="card-text"><b>{{ $notaFinal }}</b></p>
      
      </div>
    </div>
  </div>
</div>
</div>
    <div class="container-fluid d-flex justify-content-center mt-2 mx-auto my-auto">
        <div class="row">
            @foreach ($cabecalho as $cabecalho)
                <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 mt-3 ">
                    <div class="card text-center " style="border-color: #6b9dd8">
                        <div class="card-body ">
                            <h5 class="card-title" style="font-size: 90%;">{{ $cabecalho->CLASSIFICACAO }}</h5>
                            <p class="card-text"><b>{{ $cabecalho->MEDIA }}</b></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
