<x-app-layout>
    <div class="container-fluid my-5">
        <form 
            action="{{ route('questions.store', ['id' => $id]) }}" 
            method="POST"
        >    
            @csrf 
            @foreach ($questoes as $key => $questao)
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
                        <input class="form-check-input " style="margin-left:30%;position:relative;" type="radio"
                            name="questao_{{ $key }}" id="questao_{{  $key }}" value="{{ $resposta->AG_RESPOSTA }}" required>
                        <label class="form-check-label ms-3" for="questao_{{  $key }}"> {{ $resposta->RESPOSTA }}
                        </label> <br />
                    @endforeach
                </div>
            </div>
            @endforeach
<button type="submit">enviar</button>
</form>
    </div>
</x-app-layout>
