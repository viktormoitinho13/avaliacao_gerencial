<x-app-layout>
    <div class="container-fluid">
        <div class="row mt-5">
            @if (session()->has('err'))
                <div class="container-md mx-auto text-center">
                    <div class=" alert alert-danger">
                        {{ session('err') }}
                    </div>
                </div>
          @elseif (session()->has('sucess'))
                <div class="container-md mx-auto text-center">
                    <div class=" alert alert-success">
                        {{ session('sucess') }}
                    </div>
                </div>
            @endif
           
                 @foreach ($classificacoes as $classificacao) 
                <div class="col align-self-start col-12 col-sm-12 col-md-6	col-lg-6 col-xl-4 col-xxl-3">
                    <div class="card text-center mx-auto mb-4 mt-5 ">
                        <img src="{{ URL::asset('/imgs/capa.jpg') }}" alt="profile Pic" class="img-fluid" alt="Sample image"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                           
                            <h5 class="card-title">{{ $classificacao->CLASSIFICACAO }}</h5>
                          @if(in_array($classificacao->AG_CLASSIFICACAO, $blockbuttonform))
                                <a  class="btn btn-primary px-3"
                                style="background-color: #F6B618; color:rgb(0, 0, 0); border-color:rgb(255, 255, 255);"><i class="fas fa-handshake" aria-hidden="true"></i> Formulário respondido</a>
                           @else 
                                <a href="/form/{{ $classificacao->AG_CLASSIFICACAO }}" class="btn btn-primary px-3"
                                style="background-color: #6B9DD8; color:white;"><i class="fas fa-hand-point-right"
                                    aria-hidden="true"></i> Ir ao questionário</a>
                            @endif
                        
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
