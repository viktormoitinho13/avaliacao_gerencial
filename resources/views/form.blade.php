<x-app-layout>

@foreach ($questoes  as $questao)
<p>{{$questao->ag_questao}}</p>
<p>{{$questao->ag_classficacao}}</p>
    
@endforeach
</x-app-layout>
