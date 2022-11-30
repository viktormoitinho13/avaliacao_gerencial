<x-app-layout>
    <div class="container-fluid ">
        @foreach ($questoes as $questao)
            <form action="/form2" method="GET">
                @csrf
                <div class="card w-50 mx-auto mb-1 mt-5 ">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="card-header text-white" style="background-color: #6B9DD8;">
                                <input type="text " style="text-align:center;font-weight:light;color:white;" readonly
                                    class="form-control-plaintext" id="{{ $questao->AG_QUESTAO }}"
                                    value="{{ $questao->QUESTAO }} ">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3 mt-3">
                        @foreach ($questao->respostas as $resposta)
                            <input class="form-check-input " style="margin-left:30%;position:relative;"
                                    type="radio" name="flexRadioDefault" id="{{ $resposta->AG_RESPOSTA }}" required>
                                <label class="form-check-label ms-3" for="flexRadioDefault1"> {{ $resposta->RESPOSTA }} 
                                </label> <br />
                        @endforeach
                    </div>
          </div>       
    </form>
     @endforeach
    <br />
    </div>
</x-app-layout>