<x-app-layout>
    <div class="container-fluid ">
        @foreach ($questoes as $questao)
            <form action="#" method="POST">
                <div class="card w-50 mx-auto mb-1 mt-5 ">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="card-header ">
                                <input type="text" style="text-align:center;font-weight:light;" readonly
                                    class="form-control-plaintext" id="{{ $questao->AG_QUESTAO }}"
                                    value="{{ $questao->QUESTAO }} ">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3 mt-3">
                        @foreach ($questao->respostas as $resposta)
                            @if ($length = Str::length($resposta->RESPOSTA) < 10)
                                <input class="form-check-input" style="margin-left:11%;position:relative;"
                                    type="radio" name="inlineRadioOptions" id="{{ $resposta->AG_RESPOSTA }}"
                                    value="{{ $resposta->AG_RESPOSTA }}">
                                <label class="form-check-label ms-3"
                                    for="inlineRadio1">{{ $resposta->RESPOSTA }}</label>
                            @elseif (($length = Str::length($resposta->RESPOSTA) > 10) && ($length = Str::length($resposta->RESPOSTA) < 15) )
                                <input class="form-check-input" style="margin-left:20%;position:relative;"
                                    type="radio" name="inlineRadioOptions" id="{{ $resposta->AG_RESPOSTA }}"
                                    value="{{ $resposta->AG_RESPOSTA }}">
                                <label class="form-check-label ms-3"
                                    for="inlineRadio1">{{ $resposta->RESPOSTA }}</label>
                            @else
                                <input class="form-check-input " style="margin-left:30%;position:relative;"
                                    type="radio" name="flexRadioDefault" id="{{ $resposta->AG_RESPOSTA }}">
                                <label class="form-check-label ms-3" for="flexRadioDefault1"> {{ $resposta->RESPOSTA }}
                                </label> <br />
                            
                            @endif
                        @endforeach
                    </div>
    </div>
    @if ($loop->last)
        <div class="d-grid gap-2 col-6 mx-auto mt-3 ">
          <input type="submit" value="enviar">
        </div>
    @endif
    </form>
    @endforeach
    <br />
    </div>
</x-app-layout>
