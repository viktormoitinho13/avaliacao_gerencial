<x-app-layout>
    <div class="container-fluid">
        <div class="row mt-5">
            @if (session()->has('err'))
                <div class="d-flex d-flex justify-content-center mt-4">
                    <div class="col align-self-start col-12 col-sm-12 col-md-8	col-lg-6 col-xl-6 col-xxl-4">
                        <div class=" alert alert-danger text-center">
                            {{ session('err') }}
                        </div>
                    </div>
                </div>
            @elseif (session()->has('sucess'))
                <div class="container-md mx-auto text-center">
                    <div class=" alert alert-success">
                        {{ session('sucess') }}
                    </div>
                </div>
            @endif
            @if (auth()->user()->manager == 'N' and auth()->user()->supervisor == 'N')
                @foreach ($classificacoes as $classificacao)
                    <div class="d-flex d-flex justify-content-center mt-4">
                        <div class="col align-self-start col-12 col-sm-12 col-md-8	col-lg-6 col-xl-6 col-xxl-4">
                            <div class="card mx-auto mb-4 mt-4 shadow  bg-white rounded "
                                style="border-color: #b1d5ff; background-color:#e3f0ff1a">
                                <div class="card-body text-primary">
                                    <h1 class="title text-center text-dark mt-4" style="font-size: 50px;">Avaliação
                                        gerencial </h1>
                                    @foreach ($gerenteNome as $gerenteNome)
                                        <p class="fw-normal  text-center text-capitalize mt-4"
                                            style="font-size: 25px; color:#268bff;"> {{ $gerenteNome->NOME }}
                                        </p>
                                    @endforeach
                                    <div class="container-md mx-auto ">
                                        <div class="d-flex justify-content-center">
                                            <p class="card-text text-justify text-dark mt-4 col-8  "
                                                style="text-align: justify; font-size:20px;">
                                                Faz parte da <b>cultura da nossa empresa </b> dar suporte ao
                                                desenvolvimento dos nossos colaboradores, para isso utilizamos a
                                                ferramenta de <b>Feedbacks com a finalidade de melhorar os
                                                    desempenhos</b>
                                                dentro da nossa organização. Você está recebendo esse formulário para
                                                <b>
                                                    avaliar o desempenho do seu gerente</b>, para que ele possa receber
                                                um
                                                feedback e ter a oportunidade de se desenvolver conosco.
                                                A avaliação é <b>obrigatória e sigilosa</b>, pedimos que você responda
                                                com sinceridade para que tenhamos direcionamento para melhorarmos
                                                juntos.
                                                Avalie o seu gerente pelas ações ocorridas nos últimos meses.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        @if ($contarStatus == $contarQuestoes)
                                            <a class="btn btn-primary px-3 mt-4 mb-4"
                                                style="background-color: #F6B618; color:rgb(0, 0, 0); border-color:rgb(255, 255, 255);"><i
                                                    class="fas fa-handshake" aria-hidden="true"></i> Avaliação já
                                                realizada! </a>
                                        @elseif ($contarStatus != $contarQuestoes and ($data != '8' or $data = !'2'))
                                            <a class="btn btn-primary px-3 mt-4 mb-4"
                                                style="background-color: #f61818; color:rgb(255, 255, 255); border-color:rgb(255, 255, 255);"><i
                                                    class="fas fa-thumbs-down" aria-hidden="true"></i> Avaliação não
                                                disponível </a>
                                        @elseif ($gerenteNome == null)
                                            <a class="btn btn-primary px-3 mt-4 mb-4"
                                                style="background-color: #f61818; color:rgb(255, 255, 255); border-color:rgb(255, 255, 255);">
                                                <i class="fas fa-thumbs-down" aria-hidden="true"></i> Avaliação não
                                                disponível </a>
                                        @else
                                            <a href="{{ route('questions.index', $classificacao->AG_CLASSIFICACAO) }}"
                                                class="btn btn-primary px-3 mt-4 mb-4"
                                                style="background-color: #f61818; color:rgb(255, 255, 255);border-color:#ff0000;"><i
                                                    class="fas fa-hand-point-right" aria-hidden="true"></i> Li e quero
                                                continuar! </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif (auth()->user()->manager == 'S' and auth()->user()->store == '990')
                       <div class="d-flex justify-content-center mt-1">
                    <div class="col align-self-center col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-8">
                        <div class="form-inline mb-5 d-flex justify-content-center">
                            <div class="col align-self-center col-8 col-sm-8 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                <form class="my-2 my-lg-0 d-flex" id="buscaLoja" method="GET">
                                    <div class="input-group">
                                        <input class="form-control form-control-sm " type="text" id="loja" 
                                            name="loja" placeholder="Pesquisar por loja" style="border-radius:20cm" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            <div class="input-group-append mx-2">
                                            <button class="btn px-2" style="color:#468ddd;border-color:#d5e9ff;" type="submit"><i class="fas fa-search" aria-hidden="true"></i> Buscar </button>
                                            <button class="btn px-2" style="color:#dd4646;border-color:#d5e9ff;" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i> <a style="text-decoration:none; color:#dd4646" href="{{ route('home') }}">Limpar </a> </button>

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
                                            <p class="card-text text-center" style="font-size:2ch"> 
                                                <b>
                                                 {{ $resultadoManager->name }}</b>
                                                <br/>
                                            </p>
                                            
                                            <div class="d-flex justify-content-center mt-auto">
                                               
                                                    <a href="{{ route('reportDocCorporate.index', $resultadoManager->ag_loja) }}"
                                                        class="btn px-2" style=" background-color:#eff6ff; color:#0077ff;border-color:#d5e9ff;">
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

               
            @elseif (auth()->user()->supervisor == 'S')
                <div class="d-flex justify-content-center mt-1">
                    <div class="col align-self-center col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-8">
                        <div class="form-inline mb-5 d-flex justify-content-center">
                            <div class="col align-self-center col-8 col-sm-8 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                <form class="my-2 my-lg-0 d-flex" id="buscaLoja" method="GET">
                                    <div class="input-group">
                                        <input class="form-control form-control-sm " type="text" id="loja" 
                                            name="loja" placeholder="Pesquisar por loja" style="border-radius:20cm" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            <div class="input-group-append mx-2">
                                            <button class="btn px-2" style="color:#468ddd;border-color:#d5e9ff;" type="submit"><i class="fas fa-search" aria-hidden="true"></i> Buscar </button>
                                            <button class="btn px-2" style="color:#dd4646;border-color:#d5e9ff;" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i> <a style="text-decoration:none; color:#dd4646" href="{{ route('home') }}">Limpar </a> </button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-4 g-4">
                            @foreach ($resultadoSupervisor as $resultadoSupervisor)
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header"
                                            style="background-color:#468ddd; color:white; font-size:20px">
                                            <b>Loja {{ $resultadoSupervisor->ag_loja }}</b>
                                        </div>
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <p class="card-text text-center" style="font-size:2ch"> 
                                                <b>
                                                  {{$resultadoSupervisor->name  }}</b>
                                                <br/>
                                                
                                            </p>
                                            
                                            <div class="d-flex justify-content-center mt-auto">
                                               
                                                    <a href="{{ route('reportDocCorporate.index', $resultadoSupervisor->ag_loja) }}"
                                                        class="btn px-2" style=" background-color:#eff6ff; color:#0077ff;border-color:#d5e9ff;">
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
            @elseif(auth()->user()->manager == 'S' and auth()->user()->supervisor == 'N' and auth()->user()->store != '990')
                <div class="d-flex d-flex justify-content-center mt-4">
                    <div class="col align-self-start col-12 col-sm-12 col-md-8	col-lg-6 col-xl-6 col-xxl-4">
                        <div class="card mx-auto mb-4 mt-4 shadow  bg-white rounded "
                            style="border-color: #b1d5ff; background-color:#e3f0ff1a">
                            <div class="card-body text-primary">
                                <h1 class="title text-center text-dark mt-4" style="font-size: 40px;">Relatório da
                                    avaliação gerencial </h1>
                                <div class="container-md mx-auto ">
                                    <div class="d-flex justify-content-center">
                                        <p class="card-text text-justify text-dark mt-4 col-8  "
                                            style="text-align: justify; font-size:21px;">
                                            Faz parte da <b>cultura da nossa empresa </b>dar suporte ao
                                            desenvolvimento dos nossos colaboradores, para isso utilizamos
                                            a ferramenta de <b>Feedbacks com a finalidade de melhorar os desempenhos</b>
                                            dentro da nossa organização.
                                            Você está recebendo esse relatório que foi gerado a partir das <b>avaliações
                                                do seu desempenho pelos seus colaboradores</b>, para que você possa
                                            receber um
                                            feedback e ter a oportunidade de se desenvolver conosco.
                                            <b>Essa avaliação é referente as ações ocorridas nos últimos 6 (seis)
                                                meses</b>.
                                        </p>
                                    </div>
                                </div>
                                <div class="card-body text-primary">

                                    <div
                                        class="container mx-auto my-auto center-block  mt-4 d-flex justify-content-center">
                                        <div class="col-auto">

                                            <table class="table text-center table-bordered table-responsive ">
                                                <tbody>
                                                    <thead>
                                                        <tr>
                                                            @if ($contagemLojas > 1)
                                                                <th scope="col">Lojas avaliadas</th>
                                                            @else
                                                                <th scope="col">Loja avaliada</th>
                                                            @endif
                                                            <th scope="col">Acesso para o relatório</th>
                                                        </tr>
                                                    </thead>
                                                    @foreach ($resultado as $resultado)
                                                        <tr>
                                                            <td style="font-size: 25px;">
                                                                {{ $resultado->ag_loja }}
                                                            </td>
                                                            <td>
                                                 @if($dia_relatorio_gerente != $dia_atual)
                                                                    <a href="#"
                                                                        class=" btn px-2 mt-auto"
                                                                        style="color:#dd4646;border-color:#d5e9ff;"> <i
                                                                            class="fas fa-eye" aria-hidden="true"></i>
                                                                        Relatório não disponível
                                                                    </a>
                                                            @else
                                                                <a href="{{ route('reportDoc.index', $resultado->ag_loja) }}"
                                                                    <a href="{{ route('reportDoc.index', $resultado->ag_loja) }}"
                                                                        class=" btn px-2 mt-auto"
                                                                        style="color:#468ddd;border-color:#d5e9ff;"> <i
                                                                            class="fas fa-eye" aria-hidden="true"></i>
                                                                        Visualizar relatório
                                                                    </a>
                                                            @endif    
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
