<x-app-layout>
     <div class=" d-flex justify-content-center" style="height: 80vh; margin-top: 5%">
        <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6 col-xxl-4">
            <div class="mx-auto mt-4 mb-4 bg-white rounded shadow card "
                style="border-color: #ffb1b1; background-color:#e3f0ff1a">
                <div class="card-body text-primary">
                    <h1 class="mt-4 text-center title text-dark" style="font-size: 30px;">Notas da Avaliação gerencial
                    </h1>
                    <div class="mx-auto my-auto mt-4 container-fluid center-block">
                        <div class="col-auto">
                            <table class="table ">
                                <tbody>
                                    <tr>
                                        <td>QUANTIDADE DE RESPOSTAS</td>
                                        <td>{{ $qtd_respostas }}</td>
                                    </tr>
                                    @foreach ($cabecalho as $cabecalho)
                                        <tr>
                                            <td>{{ $cabecalho->CLASSIFICACAO }}</td>
                                            <td>{{ $cabecalho->MEDIA }}</td>
                                        </tr>
                                    @endforeach
                                    <tr >
                                        <td class="table-secondary text-danger "><b>NOTA FINAL</b></td>
                                        <td class="table-secondary text-danger "><b>{{ $notaFinal }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                                 <!-- Se $feedbackMain é um único modelo -->
                               @if(isset($feedbackMain) && $feedbackMain)
                                    <form action="{{ route('feedbackReportController.index', $feedbackMain->AG_FEEDBACK_SEMESTRAL_SUPERVISAO) }}" method="get">
                                        <button type="submit" class="ml-4 btn btn-lg btn-success" >
                                             <i class="fas fa-thumbs-up"></i> Acessar feedback
                                        </button>
                                    </form>
                                @else
                                    <form action="#" method="get">
                                        <button type="submit" class="ml-4 btn btn-lg btn-danger">
                                             <i class="fas fa-thumbs-down"></i>  Nenhum feedback disponível
                                        </button>
                                    </form>
                                @endif



                        </div>
                    </div>
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
