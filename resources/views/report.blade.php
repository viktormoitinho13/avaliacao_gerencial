
<x-app-layout>

<div class="mx-auto my-auto container-fluid center-block" >
<div class="mt-5 row">
 @foreach ($results as $results)

      <div class="mx-auto my-auto mt-5 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-5 col-xxl-4">
    <div class="text-center card" style="width: 90%; border-color:#6B9DD8;" >
      <div class="card-body" >
        <h3 class="text-center card-title">Relatório de avaliação gerencial</h3>
        <h6 class="mt-2 text-center card-text">Avaliação respondida pelos funcionários da </h6>
        <p class="mt-1 card-text"><small class="text-muted">Avaliação de: {{ $data}} </small></p>
      <div class="text-center">
        <a href="/reportDoc/{{ $results->ag_loja }}"   class="px-3 mt-1 btn btn-primary"
        style="background-color: #E2304E; color:rgb(255, 255, 255);border-color:#6B9DD8;"><i
        class="fas fa-hand-point-right" aria-hidden="true"></i> Gerar relatório </a>
    </div>
      </div>
    </div>
  </div>
     
@endforeach
</div>
</div>
</x-app-layout>