<x-app-layout>


@foreach($questoes as $questao)
<div class="card" style="width: 18rem;">
 <div class="card-header">
   <p>{{$questao->QUESTAO}}</p>
  </div>
 @foreach($questao->respostas as $resposta)
  <ul class="list-group list-group-flush">
    <li class="list-group-item"> <p>{{$resposta->RESPOSTA}}</p></li>

  </ul>
   @endforeach

</div>
<br/>
@endforeach


</x-app-layout>
