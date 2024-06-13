<x-app-layout>
    <div class="mx-auto my-auto container-fluid center-block">
        <div class=" row">
            <div class="mt-1 d-flex justify-content-center">
                <div class="col align-self-center col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-8">
                   

                    <x-search-form route="listReportMonth" />

                    <div class=" row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 g-4" >
                        @foreach ($resultadoManager as $resultado)
                            <div class="col">
                                <div class="card">
                                    @if ($mes == 2 or $mes == 8)
                                        <div class="card-header d-flex justify-content-between"
                                            style="background-color: #E2304E; color:white; font-size:120%">
                                            <div>
                                                <b>Loja {{ $resultado->loja }} </b>
                                            </div>
                                            <div>
                                                <b> <i class="fa-solid fa-s"></i></b>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-header d-flex justify-content-between"
                                            style="background-color: #468ddd; color:rgb(255, 255, 255); font-size:120%">
                                            <div>
                                                <b>Loja {{ $resultado->loja }} </b>
                                            </div>
                                            <div>
                                                <b> <i class="fa-solid fa-m"></i></b>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="mt-2 card-body d-flex flex-column justify-content-between">
                                        <p class="text-center card-text" style="font-size:110%;">
                                            <b>{{ $resultado->nome }}</b>
                                            <br />
                                        </p>
                                        <div class="mt-2 mb-2 d-flex justify-content-center">
                                            <a href="{{ route('ReportDocMonth.index', ['loja' => $resultado->loja, 'mes' => $mes, 'ano' => $ano]) }}"
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


                     <x-pagination :paginator="$resultadoManager" />

                 
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

