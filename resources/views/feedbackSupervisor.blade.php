<x-app-layout>
  <div class="mx-auto my-auto container-fluid center-block">
        <div class="mt-5 row">
            <div class="mt-1 d-flex justify-content-center">
                <div class="col align-self-center col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-8">
                           <x-search-form route="feedbackSupervisor.index" />
                             <div class="mt-2 row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 g-4" >
                                @foreach ($feedbackList as $resultado)
                            <div class="col">
                                <div class="card">
                                        <div class="card-header d-flex justify-content-between"
                                            style="background-color: #E2304E; color:white; font-size:120%">
                                            <div>
                                                <b>Loja {{ $resultado->LOJA }} </b>
                                            </div>
                                            <div>
                                                <b><i class="fa-solid fa-f"></i> <i class="fa-solid fa-b"></i></b>
                                            </div>
                                        </div>
                                 
                                    <div class="mt-2 card-body d-flex flex-column justify-content-between">
                                        <p class="text-center card-text" style="font-size:110%;">
                                            <b>{{ $resultado->NOME }}</b>
                                            <br />
                                        </p>
                                        <div class="mt-2 mb-2 d-flex justify-content-center">
                                             <a href="{{ route('feedbackReportController.index', $resultado->AG_FEEDBACK_SEMESTRAL_SUPERVISAO) }}"
                                                class="px-1 btn"
                                                style="background-color:#fffcfc; color:#E2304E; border-color:#ffd5d5;">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                                Visualizar feedback
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                   
                    <div class="mt-4 d-flex justify-content-center fixed-bottom ">
                        <ul class="pagination">
                            {{-- Botão Anterior --}}
                            @if ($feedbackList->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Primeira Página</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link text-danger" href="{{ $feedbackList->previousPageUrl() }}"
                                        rel="prev "> <i class="fa-solid fa-angles-left"></i> Anterior</a>
                                </li>
                            @endif

                            {{-- Botão Próximo --}}
                            @if ($feedbackList->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link text-danger" href="{{ $feedbackList->nextPageUrl() }}"
                                        rel="next">Próximo <i class="fa-solid fa-angles-right"></i></a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Última página </span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

