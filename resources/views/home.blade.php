<x-app-layout>
    <div class="container-fluid">
        <div class="mt-3 row">
            @if (session()->has('err'))
                <div class="mt-4 d-flex justify-content-center">
                    <div class="col align-self-start col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6 col-xxl-4">
                        <div class="text-center alert alert-danger">
                            {{ session('err') }}
                        </div>
                    </div>
                </div>
            @elseif (session()->has('sucess'))
                <div class="mx-auto text-center container-md">
                    <div class=" alert alert-success">
                        {{ session('sucess') }}
                    </div>
                </div>
            @endif
            @if (auth()->user()->manager == 'N' and auth()->user()->supervisor == 'N')
              @foreach ($classificacoes ?? [] as $classificacao)
    <div class="mt-5 d-flex justify-content-center">
        <div class="col align-self-start col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6 col-xxl-4">
            <div class="mx-auto mt-4 mb-4 bg-white rounded shadow card" style="border-color: #ff0000; background-color:#e3f0ff1a">
                <div class="card-body text-primary">
                    <h1 class="mt-4 text-center title text-dark" style="font-size: 50px;">Avaliação gerencial</h1>
                    @foreach ($gerenteNome ?? [] as $gerente)
                        <p class="mt-4 text-center fw-normal text-capitalize" style="font-size: 25px; color:#E2304E;">{{ $gerente->NOME }}</p>
                    @endforeach
                    <div class="mx-auto container-md">
                        <div class="d-flex justify-content-center">
                            <p class="mt-4 text-justify card-text text-dark col-8" style="text-align: justify; font-size:20px;">
                                Faz parte da <b>cultura da nossa empresa</b> dar suporte ao desenvolvimento dos nossos colaboradores, para isso utilizamos 
                                a ferramenta de <b>Feedbacks com a finalidade de melhorar os desempenhos</b> 
                                dentro da nossa organização. Você está recebendo esse formulário para <b>avaliar o desempenho do seu gerente</b>, 
                                para que ele possa receber um feedback e ter a oportunidade de se desenvolver conosco. A avaliação é <b>obrigatória e sigilosa</b>, 
                                pedimos que você responda com sinceridade para que tenhamos direcionamento para melhorarmos juntos. 
                                Avalie o seu gerente pelas ações ocorridas nos últimos meses.
                            </p>
                        </div>
                    </div>
                    <div class="text-center">

                     @if($mes % 2 == 0)

                        @if (($ativo->STATUS ?? 'N') == 'S' && $questoesMensaisstatus == 'N')
                            <a class="px-3 mt-4 mb-4 btn btn-primary" style="background-color: #F6B618; color:rgb(0, 0, 0); border-color:rgb(255, 255, 255);"><i class="fas fa-handshake" aria-hidden="true"></i> Avaliação já realizada!</a>
                        @elseif (($ativo->STATUS ?? 'N') == 'N' && $questoesMensaisstatus == 'N')
                            <a class="px-3 mt-4 mb-4 btn btn-primary" style="background-color: #f61818; color:rgb(255, 255, 255); border-color:rgb(255, 255, 255);"><i class="fas fa-thumbs-down" aria-hidden="true"></i> Avaliação não disponível</a>
                        @elseif (($ativo->STATUS ?? 'N') == 'X')
                            <a href="{{ route('questions.index', $classificacao->AG_CLASSIFICACAO) }}" class="px-3 mt-4 mb-4 btn btn-primary" style="background-color: #6B9DD8; color:rgb(255, 255, 255);border-color:#6B9DD8;"><i class="fas fa-hand-point-right" aria-hidden="true"></i> Li e quero continuar!</a>
                        @elseif ($questoesMensaisstatus == 'S')
                            <a href="{{ route('questionsMonth.index', $classificacoesMensais->ID_CLASSIFICACAO ?? 0) }}" class="px-3 mt-4 mb-4 btn btn-primary" style="background-color: #6B9DD8; color:rgb(255, 255, 255);border-color:#6B9DD8;"><i class="fas fa-hand-point-right" aria-hidden="true"></i> Responder as questões mensais</a>
                        @elseif ($gerenteNome == null)
                            <a class="px-3 mt-4 mb-4 btn btn-primary" style="background-color: #f61818; color:rgb(255, 255, 255); border-color:rgb(255, 255, 255);"><i class="fas fa-thumbs-down" aria-hidden="true"></i> Avaliação não disponível</a>
                        @endif
                        @else
                        <a class="px-3 mt-4 mb-4 btn btn-primary" style="background-color: #f61818; color:rgb(255, 255, 255); border-color:rgb(255, 255, 255);"><i class="fas fa-thumbs-down" aria-hidden="true"></i> Avaliação não disponível</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
            @elseif (auth()->user()->manager == 'S' and auth()->user()->store == '990')
                <div class="d-flex justify-content-center"style="margin-top: 7%;">
                    <div class="col align-self-start col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6 col-xxl-4">
                        <div class="mx-auto mt-4 mb-4 bg-white rounded shadow card "
                            style="border-color: #ff0000; background-color:#e3f0ff1a">
                            <div class="card-body ">
                                <div class="p-3 rounded ">
                                    <div class="text-start row">
                                        <div class="col-12">
                                            <h1>Painel de ações</h1>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center"
                                        style="margin-top: 8%;">
                                        <div class="col-md-8">
                                            <div class="text-center card" style="width: 100%; border-color: #ffabab;">
                                                <div
                                                    class="align-middle card-body d-flex flex-column justify-content-center">
                                                    <h3 class="card-title">Relatórios</h3>
                                                    <p class="mt-2 text-center card-text fst-italic">
                                                        Aqui você poderá analisar as avalições gerenciais realizadas
                                                        filtrando por mês e ano.
                                                    </p>
                                                    <div class="mt-auto d-flex justify-content-center">
                                                        <a href="{{ route('listReportMonth') }}" class="px-2 mt-2 btn"
                                                            style="background-color:#ffffff; color:#E2304E;border-color:#ffa8b7;border-radius:20cm">
                                                            <i class="fas fa-eye" aria-hidden="true"></i>
                                                            Visualizar relatório
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    @elseif (auth()->user()->supervisor == 'S')
        <div class="container d-flex justify-content-center align-items-stretch" style="margin-top:5%;" >
            <div class="p-2 mx-2 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-8">
                <div class="mx-auto mt-auto bg-white rounded shadow card"
                    style="border-color: #E2304E; background-color:#e3f0ff1a" >
                    <div class="card-body">
                        <div class="p-4 rounded">
                            <div class="row">
                                <div class="mb-4 col">
                                    <h2>Avaliações gerenciais</h2>
                                </div>
                            </div>
                            <div class="mt-4 row d-flex align-items-stretch">
                                <div class="mb-4 col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="text-center card h-100 d-flex flex-column">
                                        <div
                                            class="border card-body flex-grow-1 d-flex flex-column align-items-center border-danger">
                                            <h5 class="mt-2 text-center card-title fs-5">Relatórios</h5>
                                            <p class="mt-3 text-center card-text flex-grow-1">Aqui você poderá analisar
                                                as
                                                avalições gerenciais.</p>
                                            <a href="{{ route('listReportMonth') }}" class="px-2 mt-2 btn col-3"
                                                style="background-color:#ffefef; color:#dd4646; border-color:#ffd5d5; border-radius:20cm">
                                                <i class="text-center fas fa-eye" aria-hidden="true"></i> Visualizar
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="text-center card h-100 d-flex flex-column">
                                        <div
                                            class="border card-body flex-grow-1 d-flex flex-column align-items-center border-danger">
                                            <h5 class="mt-2 card-title fs-5">Questões Mensais</h5>
                                            <p class="mt-3 card-text flex-grow-1">Aqui você pode liberar as questões
                                                para
                                                reavaliação.</p>
                                            <a href="{{ route('ReleaseMonthlyQuestions.index') }}"
                                                class="px-2 mt-2 btn col-3"
                                                style="background-color:#ffefef; color:#dd4646; border-color:#ffd5d5; border-radius:20cm">
                                                <i class="fas fa-eye" aria-hidden="true"></i> Acessar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="text-center card h-100 d-flex flex-column">
                                        <div
                                            class="border card-body flex-grow-1 d-flex flex-column align-items-center border-danger">
                                            <h5 class="mt-2 card-title fs-5">FeedBack da avaliação</h5>
                                            <p class="mt-3 card-text flex-grow-1">
                                                Aqui você pode acessar o formulário de PDI para os gerentes.</p>
                                            <a href="{{ route('PdiFormController.index') }}"
                                                class="px-2 mt-2 btn col-6"
                                                style="background-color:#ffefef; color:#dd4646; border-color:#ffd5d5; border-radius:20cm">
                                                <i class="fas fa-eye" aria-hidden="true"></i> Gerar Feedback
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="text-center card h-100 d-flex flex-column">
                                        <div
                                            class="border card-body flex-grow-1 d-flex flex-column align-items-center border-danger">
                                            <h5 class="mt-2 card-title fs-5">Feedbacks Aplicados</h5>
                                            <p class="mt-3 card-text flex-grow-1">Aqui você pode acessar os Feedbacks
                                                aplicados.</p>
                                            <a href="{{ route('feedbackSupervisor.index') }}"
                                                class="px-2 mt-2 btn col-6"
                                                style="background-color:#ffefef; color:#dd4646; border-color:#ffd5d5; border-radius:20cm">
                                                <i class="fas fa-eye" aria-hidden="true"></i> Acessar Feedback
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(auth()->user()->manager == 'S' and auth()->user()->supervisor == 'N' and auth()->user()->store != '990')
          <div class="container d-flex justify-content-center align-items-stretch" style="margin-top:5%;">
            <div class="p-2 mx-2 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-5">
                <div class="mx-auto mt-auto bg-white rounded shadow card"
                    style="border-color: #E2304E; background-color:#e3f0ff1a">
                    <div class="card-body">
                        <div class="p-4 rounded">
                            <div class="row">
                                <div class="mb-4 col">
                                    <h2>Avaliações gerenciais</h2>
                                </div>
                            </div>
                            <div class="mt-4 row d-flex align-items-stretch">
                                <div class="mb-4 col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="text-center card h-100 d-flex flex-column">
                                        <div
                                            class="border card-body flex-grow-1 d-flex flex-column align-items-center border-danger">
                                            <h5 class="mt-2 text-center card-title">Relatórios</h5>
                                            <p class="mt-3 text-center card-text flex-grow-1">
                                                Aqui você poderá analisar as avalições gerenciais.</p>
                                            <a href="{{ route('managerHomeController.index') }}" class="px-2 mt-2 btn col-6"
                                                style="background-color:#ffefef; color:#dd4646; border-color:#ffd5d5; border-radius:20cm">
                                                <i class="text-center fas fa-eye" aria-hidden="true"></i> Visualizar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="text-center card h-100 d-flex flex-column">
                                        <div
                                            class="border card-body flex-grow-1 d-flex flex-column align-items-center border-danger">
                                            <h5 class="mt-2 card-title">Histórico de feedbacks</h5>
                                            <p class="mt-3 card-text flex-grow-1">Aqui você pode visualizar todos os seus antigos feedbacks.</p>
                                            <a href="{{ route('managerFeedbackHistory.index') }}"
                                                class="px-2 mt-2 btn col-6"
                                                style="background-color:#ffefef; color:#dd4646; border-color:#ffd5d5; border-radius:20cm">
                                                <i class="fas fa-eye" aria-hidden="true"></i> Acessar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
