<x-app-layout>
    <div
        class="mx-auto my-4 mt-5 container-fluid col-md-6 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-6 offset-md-3">
        @foreach ($classificacoes as $classificacao)
            <div class="mt-4 d-flex justify-content-center">
                <h1 class="text-center fs-3 text-capitalize" style="color:#3083e2; -webkit-text-stroke:  #3083e2;">
                    {{ $classificacao }}
                </h1>
            </div>
        @endforeach
        <form action="{{ route('respostasMonth.store', ['id' => $id]) }}" method="POST">
            @csrf
            @foreach ($questoes as $key => $questao)
                <div class="mx-auto mt-5 mb-1 bg-white rounded shadow-sm card w-100 "
                    style="border-color: #3083e2; background-color:#e3f0ff1a">
                    <div class="form-group row">
                        <div class="text-center col-sm-12">
                            <div class="text-white card-header fs-6 "
                                style="background-color: #3083e2; overflow-wrap:break-word;">
                              <strong>{{ $questao->QUESTAO }}</strong>  
                            </div>
                        </div>
                    </div>
                    <div class="row bd-highlight">
                        @foreach ($questao->respostas as $resposta)
                            @if (($length = Str::length($resposta->RESPOSTA) < 10) and $resposta->RESPOSTA != 'dissertativa')
                                <div
                                    class="p-2 mx-auto col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 bd-highlight d-flex justify-content-center">
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
                            @elseif (($length = Str::length($resposta->RESPOSTA) > 10) and $resposta->RESPOSTA != 'dissertativa')
                                <div class="h-100 d-flex align-items-center justify-content-center">
                                    <div
                                        class="p-2 col-md-6 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
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
                            @elseif ($resposta->RESPOSTA === 'dissertativa')
                                <div class="h-100 d-flex align-items-center justify-content-center">
                                    <div  class="p-2 col-md-6 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div>
                                            <textarea name="questao[{{ $questao->AG_QUESTAO }}]"
                                                id="questao_{{ $key }}_{{ $resposta->AG_RESPOSTA_DESCRICAO }}" cols="30" rows="6"
                                                style="width: 100%;" required></textarea>
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
                    <div class="text-center col">
                        <button class="mx-auto my-4 text-center btn btn-lg btn-block col-2 offset-md-3"
                            style="background-color:#3083e2; color:white;"> Enviar  <i class="fas fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
