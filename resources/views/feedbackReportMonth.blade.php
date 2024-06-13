<x-app-layout>
    <div class="container-fluid center-block d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-6 col-lg-8" style="margin-top: 2%;">
            <div class="card" style="border-color: #d86b6b;">
                <div class="card-body">
                    <div class="mx-auto ">
                        <div class="container " style="margin-top: 1%;">
                            <div class="col-12 col-md-12">
                                <h2 class="p-1 text-center text-white rounded-2 fs-1 bg-danger">Feedback da Avaliação
                                    Gerencial
                                </h2>
                            </div>
                            <div class="row justify-content-center" style="margin-top: 6%;">
                                <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10 col-xxl-8">
                                    <div class="table-responsive ">
                                        <table class="table mx-auto text-center table-bordered rounded-5">
                                            <tbody>
                                                @foreach ($feedbackDescription as $feedback)
                                                    <tr>
                                                        <th scope="row" class="text-center text-white bg-danger">Nome
                                                            do Gerente</th>
                                                        <td>{{ $feedback->NOME }}</td>
                                                        <th scope="row" class="text-center text-white bg-danger">Loja
                                                        </th>
                                                        <td>{{ $feedback->LOJA }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="text-center text-white align-middle bg-danger">Data
                                                            do Feedback</th>
                                                        <td>{{ $feedback->DATA_FEEDBACK }}</td>
                                                        <th scope="row" class="text-center text-white bg-danger">
                                                            Supervisor</th>
                                                        <td>{{ $feedback->NOME_SUPERVISOR }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if ($feedbackSelfPerceptionConfirmation == 'S' )
                                    <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10 col-xxl-12">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="mt-5 col-12 col-sm-12 col-xl-8">
                                                <table class="table table-bordered table-hover border-secondary">
                                                    <thead>
                                                        <tr class="text-center text-white bg-danger">
                                                            <th scope="col" class="text-center text-white bg-danger">
                                                                Auto Percepção
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>

                                                            <td class="overflow-auto text-start text-break" style="max-height: 100%;">
                                                                @foreach ($feedbackSelfPerception as $fsp)
                                                                    {{ $fsp->AUTO_PERCEPCAO }}
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                               
                                @endif
                            </div>
                            <div class="mt-5 row justify-content-center" >
                                <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10 col-xxl-3">
                                    <div class="table-responsive">
                                        <table class="table mx-auto text-center table-bordered rounded-5 table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center text-white bg-danger">Objetivo Principal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                  @foreach ($feedbackDescription as $fs)
                                                        @if (!empty($fs->OBJETIVO))
                                                            <tr>
                                                                <td class="overflow-auto text-start text-break" style="max-height: 100%;">
                                                                    {{ $fs->OBJETIVO }}
                                                                </td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10 col-xxl-3">
                                    <div class="table-responsive">
                                        <table class="table mx-auto text-center table-bordered rounded-5 table-hover">
                                            <thead>
                                                <tr class="text-center text-white bg-danger">
                                                        <th scope="col" class="text-center text-white bg-danger">
                                                            Habilidades Reconhecidas</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($feedbackDetails as $feedbackDetail)
                                                        @if (!empty($feedbackDetail->HABILIDADES_RECONHECER))
                                                            <tr>
                                                                <td class="overflow-auto text-start text-break" style="max-height: 100%;">
                                                                    {{ $feedbackDetail->HABILIDADES_RECONHECER }}
                                                                </td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                 </div>

                          <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10 col-xxl-3">
                                    <div class="table-responsive">
                                        <table class="table mx-auto text-center table-bordered rounded-5 table-hover">
                                            <thead>
                                                <tr class="text-center text-white bg-danger">
                                                        <th scope="col" class="text-center text-white bg-danger">
                                                            Habilidades a Desenvolver</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($feedbackDetails as $feedbackDetail)
                                                        @if (!empty($feedbackDetail->HABILIDADES_DESENVOLVER))
                                                            <tr>
                                                                <td class="overflow-auto text-start text-break" style="max-height: 100%;">
                                                                    {{ $feedbackDetail->HABILIDADES_DESENVOLVER }}
                                                                </td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                 </div>
                             
                               <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10 col-xxl-3">
                                    <div class="table-responsive">
                                        <table class="table mx-auto text-center table-bordered rounded-5 table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center text-white bg-danger">Anotações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                  @foreach ($feedbackDescription as $fd)
                                                        @if (!empty($fd->ANOTACOES))
                                                            <tr>
                                                                <td class="overflow-auto text-start text-break" style="max-height: 100%;">
                                                                    {{ $fd->ANOTACOES }}
                                                                </td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mb-3 row">
                                <div class="container ">
                                    <div class="row">
                                        <div class="col-12">
                                          <div class="table-responsive">
                                            <div class="header-table-container">
                                                <h3 class="p-2 mb-0 text-center text-white fs-4 bg-danger">Plano de Ação</h3>
                                                <table class="table mb-0 table-bordered table-hover border-secondary">
                                                    <thead>
                                                        <tr class="text-center"
                                                            style="background-color: #e9e9e9 ; font-size:95%;">
                                                            <th scope="col" class="text-center text-white bg-danger">
                                                                Ação</th>
                                                            <th scope="col" colspan="2"
                                                                class="text-center text-white bg-danger ">Período</th>
                                                            <th scope="col" class="text-center text-white bg-danger">
                                                                Entregas</th>
                                                            <th scope="col" class="text-center text-white bg-danger">
                                                                Recursos</th>
                                                            <th scope="col"
                                                                class="text-center text-white bg-danger">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($feedbackDetailsPlanosAcoes as $feedbackDetailPlanoAcao)
                                                            <tr>
                                                                <td class="overflow-auto align-middle"
                                                                    style="max-height: 100%;">
                                                                    {{ $feedbackDetailPlanoAcao->ACAO_PLANO_ACAO }}
                                                                </td>
                                                                <td class="overflow-auto text-center align-middle"
                                                                    style="max-height: 100%;">
                                                                    {{ $feedbackDetailPlanoAcao->DATA_INICIAL_PLANO_ACAO }}
                                                                </td>
                                                                <td class="overflow-auto text-center align-middle"
                                                                    style="max-height: 100%;">
                                                                    {{ $feedbackDetailPlanoAcao->DATA_FINAL_PLANO_ACAO }}
                                                                </td>
                                                                <td class="overflow-auto align-middle"
                                                                    style="max-height: 100%;">
                                                                    {{ $feedbackDetailPlanoAcao->ENTREGA_PLANO_ACAO }}
                                                                </td>
                                                                <td class="overflow-auto align-middle"
                                                                    style="max-height: 100%;">
                                                                    {{ $feedbackDetailPlanoAcao->RECURSO_PLANO_ACAO }}
                                                                </td>
                                                                <td class="overflow-auto align-middle"
                                                                    style="max-height: 100%;">
                                                                    {{ $feedbackDetailPlanoAcao->STATUS_PLANO_ACAO }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 d-flex justify-content-center">
                                                  
                                    @if($feedbackManagerCheck == 'S')  
                                        <button type="button" class="text-black align-middle btn fw-bold rounded-2 " style="background-color:#f6bf35 ;">
                                            Feedback Aceito <i class="fa-solid fa-user-check"></i>
                                        </button>
                                 
                                     @else 
                                         <button type="button" class="text-white align-middle btn btn-danger fw-bold rounded-2 ">
                                            Feedback não aceito <i class="fa-solid fa-x"></i>
                                        </button>
                                 @endif
                                <!-- Modal -->
                              
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
