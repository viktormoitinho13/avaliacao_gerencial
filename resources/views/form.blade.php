<x-app-layout>
    <div class="container-fluid col-md-6 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-6 offset-md-3 my-4 mx-auto mt-4">
         @foreach ($classificacao as $classificacao)
            <div class="d-flex d-flex justify-content-center mt-4">
         
            <h1 class="text-center fs-3 text-center text-capitalize"style="font-family:serif; color:#6B9DD8; -webkit-text-stroke:  #6B9DD8;">{{ $classificacao }}</h1>
        </div>
         @endforeach
        <form action="{{ route('respostas.store', ['id' => $id]) }}" method="POST">
            @csrf
            @foreach ($questoes as $key => $questao)
               
                <div class="card w-100 mx-auto mb-1 mt-4 shadow-sm  bg-white rounded " style="border-color: #b1d5ff; background-color:#e3f0ff1a">
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <div class="card-header text-white fs-6 " style="background-color: #6B9DD8; overflow-wrap:break-word;">
                                {{ $questao->QUESTAO }}
                            </div>
                        </div>
                    </div>
                    <div class="row bd-highlight">
                        @foreach ($questao->respostas as $resposta)
                                                    
                            @if ($length = Str::length($resposta->RESPOSTA) < 15)
                                <div
                                    class="p-2 col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 bd-highlight d-flex justify-content-center mx-auto" >
                                    <div>
                                        <input type="radio" name="questao[{{ $questao->AG_QUESTAO }}]"
                                            id="questao_{{ $key }}_{{ $resposta->AG_RESPOSTA }}"
                                            class="form-check-input" value="{{ $resposta->AG_RESPOSTA }}" required />
                                        <label class="form-check-label"
                                            for="questao_{{ $key }}_{{ $resposta->AG_RESPOSTA }}">
                                            {{ $resposta->RESPOSTA }}
                                        </label>
                                    </div>
                                </div>
                          
                            @else
                                <div class="h-100 d-flex align-items-center justify-content-center">
                                    <div
                                        class=" p-2 col-md-6 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12  ">
                                        <div>
                                            <input type="radio" name="questao[{{ $questao->AG_QUESTAO }}]"
                                                id="questao_{{ $key }}_{{ $resposta->AG_RESPOSTA }}"
                                                class="form-check-input" value="{{ $resposta->AG_RESPOSTA }}"
                                                required />
                                            <label class="form-check-label"
                                                for="questao_{{ $key }}_{{ $resposta->AG_RESPOSTA }}">
                                                {{ $resposta->RESPOSTA }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                    
                       
                       
                     @endforeach
                    </div>
                </div>
            @endforeach
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <button class="btn btn-lg btn-block col-4 offset-md-3 my-4 mx-auto text-center"
                            style="background-color:#6b9dd8; color:white;"><i class="fas fa-share" aria-hidden="true"> Enviar</i></button>
                    </div>
                </div>
            </div>

        </form>
       
    </div>
</x-app-layout>
