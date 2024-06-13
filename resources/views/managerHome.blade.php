 
<x-app-layout>
<div class="d-flex justify-content-center" style="margin-top: 4%; ">
            <div class="col align-self-start col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6 col-xxl-5">
                <div class="mx-auto mt-4 mb-4 bg-white rounded shadow card "
                    style="border-color: #ff0000; background-color:#e3f0ff1a">
                    <div class="card-body text-primary">
                        <h1 class="mt-5 text-center title text-dark" style="font-size: 40px;">
                            Relatório da avaliação gerencial </h1>
                        <div class="mx-auto container-md ">
                            <div class="d-flex justify-content-center">
                                <p class="mt-4 text-justify card-text text-dark col-8 "
                                    style="text-align: justify; font-size:21px;">
                                    Faz parte da<b> cultura da nossa empresa </b>dar suporte ao
                                    desenvolvimento dos nossos colaboradores, para isso utilizamos
                                    a ferramenta de <b>Feedbacks com a finalidade de melhorar os desempenhos</b>
                                    dentro da nossa organização.
                                    Você está recebendo esse relatório que foi gerado a partir das <b>avaliações
                                        do seu desempenho pelos seus colaboradores</b>, para que você possa
                                    receber um feedback e ter a oportunidade de se desenvolver conosco.
                                    <b>Essa avaliação é referente as ações ocorridas nos últimos 6 (seis) meses.</b>
                                </p>
                            </div>
                        </div>
                        <div class="card-body text-primary">
                            <div class="container mx-auto my-auto mt-4 center-block d-flex justify-content-center">
                                <div class="col-auto">
                                    <table class="table text-center table-borderless table-responsive ">
                                        <tbody>
                                            <thead>
                                                <tr>
                                                    @if ($contagemLojas > 1)
                                                        <th scope="col">Lojas avaliadas</th>
                                                    @else
                                                        <th scope="col">Loja avaliada</th>
                                                    @endif
                                                    <th scope="col">Relatório Semestral</th>

                                                </tr>
                                            </thead>
                                            @foreach ($resultado as $resultado)
                                                <tr>
                                                    <td style="font-size: 25px;">
                                                        {{ $resultado->AG_LOJA }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('reportDoc.index', $resultado->AG_LOJA) }}"
                                                            class="px-2 mt-auto btn"
                                                            style="color:#468ddd;border-color:#d5e9ff;"> <i
                                                                class="fas fa-eye" aria-hidden="true"></i>
                                                            Visualizar
                                                        </a>
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

</x-app-layout>