<x-app-layout>

@foreach($questoes as $questao)
<p>{{$questao->QUESTAO}}</p>
    @foreach($questao->respostas as $resposta)
    <p>{{$resposta->RESPOSTA}}</p>
    @endforeach

   
@endforeach

</x-app-layout>
