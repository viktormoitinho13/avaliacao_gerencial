<x-app-layout>
    <div class="container-fluid">
        <div class="row mt-5">
            @if (session()->has('err'))
                <div class="container-md mx-auto text-center">
                    <div class=" alert alert-danger">
                        {{ session('err') }}
                    </div>
                </div>
            @elseif (session()->has('sucess'))
                <div class="container-md mx-auto text-center">
                    <div class=" alert alert-success">
                        {{ session('sucess') }}
                    </div>
                </div>
            @endif
            @if (auth()->user()->office != 2)
                @foreach ($classificacoes as $classificacao)
                    <div class="d-flex d-flex justify-content-center mt-5">
                        <div class="col align-self-start col-12 col-sm-12 col-md-8	col-lg-6 col-xl-6 col-xxl-4">
                            <div class="card mx-auto mb-4 mt-4 shadow  bg-white rounded "
                                style="border-color: #b1d5ff; background-color:#e3f0ff1a">
                                <div class="card-body text-primary">
                                    <h1 class="title text-center text-dark mt-4" style="font-size: 50px;">Avaliação
                                        gerencial </h1>
                                    @foreach ($gerenteNome as $gerenteNome)
                                        <p class="fw-normal  text-center text-capitalize mt-4"
                                            style="font-size: 25px; color:#268bff;">
                                            {{ $gerenteNome->NOME }} </p>
                                    @endforeach
                                    <div class="container-md mx-auto ">
                                        <div class="d-flex justify-content-center">

                                            <p class="card-text text-justify text-dark mt-4 col-8  "
                                                style="text-align: justify; font-size:20px;">
                                                Faz parte da <b>cultura da nossa empresa </b> dar suporte ao
                                                desenvolvimento
                                                dos
                                                nossos colaboradores, para isso utilizamos a ferramenta de <b>Feedbacks
                                                    com
                                                    a
                                                    finalidade de melhorar os desempenhos</b> dentro da nossa
                                                organização.
                                                Você está recebendo esse formulário para <b>avaliar o desempenho do seu
                                                    gerente</b> ,
                                                para que ele possa receber um feedback e ter a oportunidade de se
                                                desenvolver conosco.
                                                A avaliação é <b>obrigatória e sigilosa</b>, pedimos que você responda
                                                com
                                                sinceridade para
                                                que tenhamos direcionamento para melhorarmos juntos.
                                                Avalie o seu gerente pelas ações ocorridas nos últimos meses. </p>

                                        </div>
                                    </div>
                                    <div class="text-center">
                                        @if ($contarStatus == $contarQuestoes)
                                            <a class="btn btn-primary px-3 mt-4"
                                                style="background-color: #F6B618; color:rgb(0, 0, 0); border-color:rgb(255, 255, 255);"><i
                                                    class="fas fa-handshake" aria-hidden="true"></i> Avaliação já
                                                realizada! </a>
                                        @else
                                            <a href="/form/{{ $classificacao->AG_CLASSIFICACAO }}"
                                                class="btn btn-primary px-3 mt-4"
                                                style="background-color: #d86b6b; color:rgb(255, 255, 255);border-color:#ec3f3f;"><i
                                                    class="fas fa-hand-point-right" aria-hidden="true"></i> Li e quero
                                                continuar! </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                          <div class="d-flex d-flex justify-content-center mt-5">
                        <div class="col align-self-start col-12 col-sm-12 col-md-8	col-lg-6 col-xl-6 col-xxl-4">
                            <div class="card mx-auto mb-4 mt-4 shadow  bg-white rounded "
                                style="border-color: #b1d5ff; background-color:#e3f0ff1a">
                                <div class="card-body text-primary">
                                    <h1 class="title text-center text-dark mt-4" style="font-size: 40px;">Relatório da avaliação gerencial </h1>
                                 
                                    <div class="container-md mx-auto ">
                                        <div class="d-flex justify-content-center">

                                            <p class="card-text text-justify text-dark mt-4 col-8  "
                                                style="text-align: justify; font-size:20px;">
                                                Faz parte da cultura da nossa empresa dar suporte ao
                                                desenvolvimento dos nossos colaboradores, para isso utilizamos 
                                                a ferramenta de Feedbacks com a finalidade de melhorar os desempenhos
                                                dentro da nossa organização.
                                                Você está recebendo esse relatório que foi gerado a partir das avaliações 
                                                do seu desempenho pelos  seus colaboradores, para que você possa receber um 
                                                feedback e ter a oportunidade de se  desenvolver conosco.
                                                Essa Avaliação é referente as ações ocorridas nos últimos meses. </p>

                                        </div>
                                    </div>
                                    <div class="text-center">
                                      
                                            <a href="/report"
                                                class="btn btn-primary px-3 mt-4"
                                                style="background-color: #6B9DD8; color:rgb(255, 255, 255);border-color:#6B9DD8;"><i
                                                    class="fas fa-hand-point-right" aria-hidden="true"></i> Gerar relatório </a>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                   
          
            @endif

        </div>
    </div>
</x-app-layout>
