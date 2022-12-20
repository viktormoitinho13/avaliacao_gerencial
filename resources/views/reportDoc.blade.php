<x-app-layout>
    <div class="d-flex d-flex justify-content-center mt-5">
        <div class="col align-self-start col-12 col-sm-12 col-md-8	col-lg-6 col-xl-6 col-xxl-4">
            <div class="card mx-auto mb-4 mt-4 shadow  bg-white rounded "
                style="border-color: #b1d5ff; background-color:#e3f0ff1a">
                <div class="card-body text-primary">
                    <h1 class="title text-center text-dark mt-4" style="font-size: 30px;">Notas da Avaliação gerencial
                    </h1>
                    <div class="container-fluid mx-auto my-auto center-block  mt-4">
                        <div class="col-auto">
                            <table class="table ">
                                <tbody>
                                    <tr>
                                        <td>QUANTIDADE DE RESPOSTAS</td>
                                        <td>{{ $qtd_respostas[0]->QTD_TOTAL_RESPOSTAS }}</td>
                                    </tr>
                                    @foreach ($cabecalho as $cabecalho)
                                        <tr>
                                            <td>{{ $cabecalho->CLASSIFICACAO }}</td>
                                            <td>{{ $cabecalho->MEDIA }}</td>
                                        </tr>
                                    @endforeach
                                     <tr>
                                        <td><b>NOTA FINAL</b></td>
                                        <td><B>{{ $notaFinal }}</B></td>
                                    </tr>
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
</x-app-layout>
