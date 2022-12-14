
<x-app-layout>

<div class="container-fluid mx-auto my-auto center-block" >
<div class="row mt-5">
 @foreach ($results as $results)
      @if($contagem == 1)
       relatorio
      @else 
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-5 col-xxl-4 mx-auto my-auto mt-5">
    <div class="card text-center" style="width: 90%; border-color:#6B9DD8;" >
      <div class="card-body" >
        <h3 class="card-title text-center">Relatório de avaliação gerencial</h3>
        <h6 class="card-text text-center mt-2">Avaliação respondida pelos funcionários da <b> Loja {{ $results->ag_loja }}</b></h6>
        <p class="card-text mt-1"><small class="text-muted">data da avaliação irá aparecer aqui !!!</small></p>
      <div class="text-center">
        <a href="/reportDoc/{{ $results->ag_loja }}"   class="btn btn-primary px-3 mt-1"
        style="background-color: #468ddd; color:rgb(255, 255, 255);border-color:#6B9DD8;"><i
        class="fas fa-hand-point-right" aria-hidden="true"></i> Gerar relatório </a>
    </div>
      </div>
    </div>
  </div>
      @endif 
@endforeach
</div>
</div>
</x-app-layout>