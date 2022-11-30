<x-app-layout>



<div class="container-fluid">
<div class="row mt-5">
 @foreach ($classificacoes as $classificacao)
  <div class="col-sm-3">
     <div class="card text-center w-75 mx-auto mb-1 mt-5 ">
    <img src="{{URL::asset('/imgs/capa.jpg')}}" alt="profile Pic"   class="img-fluid" alt="Sample image"  class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{ $classificacao->CLASSIFICACAO }}</h5>
       
        <a href="/form/{{ $classificacao->AG_CLASSIFICACAO }}" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
@endforeach
</div>
</div>
</x-app-layout>
