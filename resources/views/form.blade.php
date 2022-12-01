<x-app-layout>
    <div class="container-fluid my-5 col-md-6 offset-md-3">
        <form 
            action="{{ route('respostas.store', ['id' => $id]) }}" 
            method="POST">    
            @csrf 
            @foreach ($questoes as $key => $questao)
            <div class="card w-50 mx-auto mb-1 mt-5 ">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="card-header text-white" style="background-color: #6B9DD8;">
<<<<<<< HEAD
                          <h5 class="text-center">{{ $questao->QUESTAO }}</h5>
                        </div>
                    </div>
                </div>
               
                    @foreach ($questao->respostas as $resposta)
                             <div class="d-flex justify-content-center my-2" >
                          <input  class="form-check-input   "  type="radio" 
                                name="questao[{{ $questao->AG_QUESTAO }}]" 
                                  id="questao_{{ $key }}_{{ $resposta->AG_RESPOSTA }}" 
                                  value="{{ $resposta->AG_RESPOSTA }}" 
                                  required>
                          <label class="form-check-label ms-3" for="questao_{{ $key }}_{{ $resposta->AG_RESPOSTA }}">
                            {{ $resposta->RESPOSTA }} </label></br>
                            </div>                
                     @endforeach
                
=======
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
>>>>>>> 2f3c028a47761b98bf38213a94102aa7400949c2
            </div>
            @endforeach
<button type="submit" class="btn btn-lg btn-block col-md-6 offset-md-3 my-4" style="background-color:#6b9dd8; color:white;">Enviar</button>
</form>
    </div>
</x-app-layout>
