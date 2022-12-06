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
            @foreach ($classificacoes as $classificacao) 
           
            <div class="d-flex d-flex justify-content-center">
                <div class="col align-self-start col-12 col-sm-12 col-md-8	col-lg-6 col-xl-6 col-xxl-6">
                    <div class="card mx-auto mb-4 mt-4 " style="border-color: #b1d5ff; background-color:#e3f0ff1a">
                        <div class="card-body text-primary">
                            <h3 class="card-title text-center text-dark mt-4">Termos de uso</h3>
                            <div class="container-md mx-auto ">
                                <div class="d-flex justify-content-center">
                                    <p class="card-text text-justify text-dark mt-4 col-8  " style="text-align: justify;">
                                        Faz parte da cultura da nossa empresa dar suporte ao desenvolvimento dos 
                                        nossos colaboradores, para isso utilizamos a ferramenta de Feedbacks com a
                                        finalidade de melhorar os desempenhos dentro da nossa organização. 
                                        Você está recebendo esse formulário para avaliar o desempenho do seu gerente, 
                                        para que ele possa receber um feedback e ter a oportunidade de se desenvolver conosco. 
                                        A avaliação é obrigatória e sigilosa, pedimos que você responda com sinceridade para 
                                        que tenhamos direcionamento para melhorarmos juntos.
                                        Avalie o seu gerente pelas ações ocorridas nos últimos meses. </p>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="/form/{{ $classificacao->AG_CLASSIFICACAO }}" class="btn btn-primary px-3 mt-4"
                                    style="background-color: #6B9DD8; color:white;"><i class="fas fa-hand-point-right"
                                        aria-hidden="true"></i> Li e quero continuar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
   @endforeach
        </div>
    </div>
</x-app-layout>
