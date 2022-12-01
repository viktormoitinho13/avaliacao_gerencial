<x-app-layout>
    <div class="container-fluid col-md-6 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-6 offset-md-3 my-4 mx-auto">
        <form action="{{ route('respostas.store', ['id' => $id]) }}" method="POST">
            @csrf
            @foreach ($questoes as $key => $questao)
                <div class="card w-75 mx-auto mb-1 mt-4 ">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="card-header text-white fs-6"
                                style="background-color: #6B9DD8; overflow-wrap:break-word;">
                                {{ $questao->QUESTAO }}
                            </div>
                        </div>
                    </div>
                    <div class="row bd-highlight">
                        @foreach ($questao->respostas as $resposta)
                            @if ($length = Str::length($resposta->RESPOSTA) < 10)
                                <div
                                    class="p-2 col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1 bd-highlight d-flex justify-content-center mx-auto ml-auto">
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
                                        class=" p-2 col-md-6 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12  d-flex  h-100">
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
                        <button class="btn btn-lg btn-block col-8 offset-md-3 my-4 mx-auto"
                            style="background-color:#6b9dd8; color:white;">Enviar</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</x-app-layout>
