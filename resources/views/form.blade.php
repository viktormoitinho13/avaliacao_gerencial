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
                            <h5>{{ $questao->QUESTAO }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3 mt-3">
                   <div class="d-flex flex-column gap-2 p-2">
                    @foreach ($questao->respostas as $resposta)
                        <div>
                            <input 
                            type="radio"
                            name="questao[{{ $questao->AG_QUESTAO }}]" 
                            id="questao_{{ $key }}_{{ $resposta->AG_RESPOSTA }}" 
                            class="form-check-input" 
                            value="{{ $resposta->AG_RESPOSTA }}" required
                        />
                            <label 
                                class="form-check-label" 
                                for="questao_{{ $key }}_{{ $resposta->AG_RESPOSTA }}"
                            > 
                                {{ $resposta->RESPOSTA }}
                            </label> 
                        </div>
                    @endforeach
                   </div>
                </div>
            </div>
            @endforeach
<button type="submit">enviar</button>
</form>
    </div>
</x-app-layout>
