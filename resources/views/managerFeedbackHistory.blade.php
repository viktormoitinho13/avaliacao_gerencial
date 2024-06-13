<x-app-layout>
    <div class="mx-auto my-auto container-fluid center-block">
        <div class="mt-3 row">
            <div class="mt-1 d-flex justify-content-center">
                <div class="col align-self-center col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-8">
                    <x-search-form route="managerFeedbackHistory.index" />

                    <div class=" row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 g-4">
                        @foreach ($historyFeedbackManagers as $historyFeedbackManager)
                            <div class="col">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between"
                                        style="background-color: #E2304E; color:white; font-size:120%">
                                        <div>
                                            <b>Loja {{ $historyFeedbackManager->LOJA }} </b>
                                        </div>
                                        <div>
                                            <b> <i class="fa-solid fa-s"></i></b>
                                        </div>
                                    </div>

                                    <div class="mt-2 card-body d-flex flex-column justify-content-between">
                                        <p class="text-center card-text" style="font-size:110%;">
                                            <b>{{ $historyFeedbackManager->DATA_FEEDBACK }}</b>
                                            <br />
                                        </p>
                                        <div class="mt-2 mb-2 d-flex justify-content-center">
                                            <a href="{{route('managerFeedbackMonthController.index', ['loja' =>$historyFeedbackManager->LOJA, 'data_feedback' => $historyFeedbackManager->DATA_FEEDBACK ]) }}"
                                                class="px-1 btn"
                                                style="background-color:#fffcfc; color:#E2304E; border-color:#ffd5d5;">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                                Visualizar relatório
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 d-flex justify-content-center fixed-bottom">
        <ul class="pagination">
            {{-- Botão Anterior --}}
            @if ($historyFeedbackManagers->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Primeira Página</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link text-danger" href="{{ $historyFeedbackManagers->previousPageUrl() }}" rel="prev">
                        <i class="fa-solid fa-angles-left"></i> Anterior
                    </a>
                </li>
            @endif

            {{-- Botão Próximo --}}
            @if ($historyFeedbackManagers->hasMorePages())
                <li class="page-item">
                    <a class="page-link text-danger" href="{{ $historyFeedbackManagers->nextPageUrl() }}" rel="next">
                        Próximo <i class="fa-solid fa-angles-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Última página</span>
                </li>
            @endif
        </ul>
    </div>
</x-app-layout>
