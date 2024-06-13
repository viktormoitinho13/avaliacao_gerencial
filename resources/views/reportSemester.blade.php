<x-app-layout>
    <div class="mx-auto my-auto container-fluid center-block">
        <div class="mt-5 row">
            <div class="mt-1 d-flex justify-content-center">
                <div class="col align-self-center col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-8">
                    <div class="mb-5 form-inline d-flex justify-content-center">
                        <div class="col align-self-center col-8 col-sm-8 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                            <form class="my-2 my-lg-0 d-flex" id="buscaLoja" method="GET">
                                <div class="input-group">
                                    <input class="form-control form-control-sm " type="text" id="loja"
                                        name="loja" placeholder="Pesquisar por loja" style="border-radius:20cm"
                                        required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                    <div class="mx-2 input-group-append">
                                        <button class="px-2 btn" style="color:#468ddd;border-color:#d5e9ff;"
                                            type="submit"><i class="fas fa-search" aria-hidden="true"></i> Buscar
                                        </button>
                                        <button class="px-2 btn" style="color:#dd4646;border-color:#d5e9ff;"
                                            type="submit"><i class="fa fa-refresh" aria-hidden="true"></i>
                                                <a style="text-decoration:none; color:#dd4646" href="{{ route('home') }}">Limpar </a>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        @foreach ($resultadoManager as $resultadoManager)
                            <div class="col">
                                <div class="card">
                                    <div class="card-header"
                                        style="background-color:#468ddd; color:white; font-size:20px">
                                        <b>Loja {{ $resultadoManager->ag_loja }}</b>
                                    </div>
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <p class="text-center card-text" style="font-size:2ch">
                                            <b>
                                                {{ $resultadoManager->name }}</b>
                                            <br />
                                        </p>
                                        <div class="mt-auto d-flex justify-content-center">
                                            <a href="{{ route('reportDocCorporate.index', ['id' => $resultadoManager->ag_loja, 'data_ini' => '01/01/2023', 'data_fim' => '30/06/2023']) }}"
                                                class="px-2 btn"
                                                style=" background-color:#eff6ff; color:#0077ff;border-color:#d5e9ff;">
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
</x-app-layout>
