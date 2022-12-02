<x-app-layout>
<div class="container-fluid">
  <div class="row mt-5">
  @foreach ($classificacoes as $classificacao)
  <div class="col align-self-start col-12 col-sm-12 col-md-6	col-lg-6 col-xl-4 col-xxl-3">
    <div class="card text-center mx-auto mb-4 mt-5 ">
      <img src="{{URL::asset('/imgs/capa.jpg')}}" alt="profile Pic"   class="img-fluid" alt="Sample image"  class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{ $classificacao->CLASSIFICACAO }}</h5>
        
         <a href="/form/{{ $classificacao->AG_CLASSIFICACAO }}" class="btn btn-primary px-3" style="background-color: #6B9DD8; color:white;"><i class="fas fa-hand-point-right" aria-hidden="true"></i>  Ir ao questionário</a>
        
      </div>
    </div>
  </div>
  @endforeach
  </div>
</div>
</x-app-layout>
