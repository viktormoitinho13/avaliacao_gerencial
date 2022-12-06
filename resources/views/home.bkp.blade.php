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
                <div class="col align-self-start col-12 col-sm-12 col-md-6	col-lg-6 col-xl-6 col-xxl-3">
                    <div class="card text-center mx-auto mb-4 mt-4 " style="border-color: #b1d5ff; background-color:#e3f0ff1a">
                    <img class="card-img-top img-circle rounded-circle" src="{{ URL::asset('/imgs/metas.png') }}" alt="Card image cap" 
                    style="position: absolute;  top: -30px;  left: 50%;  margin-left: -30px;  width: 70px !important;  height: 70px;">
                      <div class="card-body my-3" >
                          <h5 class="card-title my-3">{{ $classificacao->CLASSIFICACAO }}</h5>
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