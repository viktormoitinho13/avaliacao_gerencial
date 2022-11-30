<x-app-layout>

 @foreach ($classificacoes as $classificacao)
<p>{{ $classificacao->AG_CLASSIFICACAO }} </p>
<p>{{ $classificacao->CLASSIFICACAO }} </p>
@endforeach



</x-app-layout>
