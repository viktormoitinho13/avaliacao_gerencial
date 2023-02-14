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
            @if (auth()->user()->manager != 'S' and auth()->user()->supervisor == 'N')
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
                                        @elseif ($contarStatus != $contarQuestoes and $data != '2' or ($data = !'8'))
                                            <a class="btn btn-primary px-3 mt-4 mb-4"
                                                style="background-color: #f61818; color:rgb(255, 255, 255); border-color:rgb(255, 255, 255);"><i
                                                    class="fas fa-thumbs-down" aria-hidden="true"></i> Avaliação não
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
                <div class="d-flex d-flex justify-content-center mt-4">
                    <div class="col align-self-start col-12 col-sm-12 col-md-8	col-lg-6 col-xl-6 col-xxl-4">
                        <div class="card mx-auto mb-4 mt-4 shadow  bg-white rounded "
                            style="border-color: #b1d5ff; background-color:#e3f0ff1a">
                            <div class="card-body text-primary">
                                <h1 class="title text-center text-dark mt-4" style="font-size: 30px;">Notas da Avaliação
                                    gerencial
                                </h1>
                                <div class="container mx-auto my-auto center-block  mt-4 d-flex justify-content-center">
                                    <div class="col-auto">
                                        <table class="table text-center table-bordered table-responsive ">
                                            <tbody>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Lojas avaliadas</th>
                                                        <th scope="col">Data de avaliação</th>
                                                        <th scope="col">Acesso para o relatório</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($resultadoManager as $resultadoManager)
                                                    <tr>
                                                        <td style="font-size: 25px;">{{ $resultadoManager->ag_loja }}
                                                        </td>
                                                        <td style="font-size: 25px;">{{ $dataRespostas }}</td>
                                                        <td> <a href="/reportDocCorporate/{{ $resultadoManager->ag_loja }}"
                                                                class=" btn px-2 mt-auto"
                                                                style="color:#468ddd;border-color:#d5e9ff;"> <i
                                                                    class=" 	fas fa-eye" aria-hidden="true"></i>
                                                                Visualizar
                                                            </a></td>
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
            @elseif (auth()->user()->supervisor == 'S')
                <div class="d-flex d-flex justify-content-center mt-4">
                    <div class="col align-self-start col-12 col-sm-12 col-md-8	col-lg-6 col-xl-6 col-xxl-4">
                        <div class="card mx-auto mb-4 mt-4 shadow  bg-white rounded "
                            style="border-color: #b1d5ff; background-color:#e3f0ff1a">
                            <div class="card-body text-primary">
                                <h1 class="title text-center text-dark mt-4" style="font-size: 30px;">Notas da Avaliação
                                    gerencial
                                </h1>
                                <div class="container mx-auto my-auto center-block  mt-4 d-flex justify-content-center">
                                    <div class="col-auto">
                                        <table class="table text-center table-bordered table-responsive ">
                                            <tbody>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Loja avaliada</th>
                                                        <th scope="col">Data de avaliação</th>
                                                        <th scope="col">Acesso para o relatório</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($resultadoSupervisor as $resultadoSupervisor)
                                                    <tr>
                                                        <td style="font-size: 25px;">{{ $resultadoSupervisor->ag_loja }}
                                                        </td>
                                                        <td style="font-size: 25px;">{{ $dataRespostas }}</td>
                                                        <td> <a href="/reportDocCorporate/{{ $resultadoSupervisor->ag_loja }}"
                                                                class=" btn px-2 mt-auto"
                                                                style="color:#468ddd;border-color:#d5e9ff;"> <i
                                                                    class=" 	fas fa-eye" aria-hidden="true"></i>
                                                                Visualizar
                                                            </a></td>
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
            @else
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
                                            style="text-align: justify; font-size:20px;">
                                            Faz parte da <b>cultura da nossa empresa </b>dar suporte ao
                                            desenvolvimento dos nossos colaboradores, para isso utilizamos
                                            a ferramenta de <b>Feedbacks com a finalidade de melhorar os desempenhos</b>
                                            dentro da nossa organização.
                                            Você está recebendo esse relatório que foi gerado a partir das <b>avaliações
                                                do seu desempenho pelos seus colaboradores</b>, para que você possa
                                            receber um
                                            feedback e ter a oportunidade de se desenvolver conosco.
                                            <b>Essa avaliação é referente as ações ocorridas nos últimos meses</b>.
                                        </p>
                                    </div>
                                </div>
                                <div class="text-center">
                                    @if ($contagem == 1 and $data == '2' or $data == '8')
                                        <a href="/reportDoc/{{ $resultado[0]->ag_loja }}"
                                            class="btn btn-primary px-3 mt-4 mb-4"
                                            style="background-color: #468ddd; color:rgb(255, 255, 255);border-color:#6B9DD8;"><i
                                                class="fas fa-hand-point-right" aria-hidden="true"></i> Visualizar
                                            relatório </a>
                                    @elseif ($contagem > 1 and $data == '2' or $data == '8')
                                        <a href="/report" class="btn btn-primary px-3 mt-4 mb-4"
                                            style="background-color: #468ddd; color:rgb(255, 255, 255);border-color:#6B9DD8;"><i
                                                class="fas fa-hand-point-right" aria-hidden="true"></i> Visualizar
                                            relatório </a>
                                    @else
                                        <a class="btn btn-primary px-3 mt-4 mb-4"
                                            style="background-color: #f61818; color:rgb(255, 255, 255); border-color:rgb(255, 255, 255);"><i
                                                class="fas fa-ban" aria-hidden="true"></i> Não existem relatórios
                                            disponíveis </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
