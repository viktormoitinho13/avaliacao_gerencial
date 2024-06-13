<x-app-layout>
    <div class="container-fluid center-block d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-6 col-lg-8" style="margin-top: 1%;">
            <div class="mt-5 card" style="border-color: #d86b6b;">
                <div class="card-body">
                    <div class="mx-auto ">
                        <div class="container " style="margin-top: 3%;">
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
                                @elseif($feedbackSelfPerceptionConfirmation == 'N' and $supervisor == 'N')
                                    <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10 col-xxl-4">
                                        <div class="mt-4 accordion accordion-flush rounded-xl" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="text-center accordion-header">
                                                    <h1 class="text-white accordion-button collapsed rounded-5 bg-danger "
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseThree" aria-expanded="false"
                                                        aria-controls="collapseThree">
                                                        Auto Percepção
                                                    </h1>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="mb-2">
                                                            <form class="row g-3"
                                                                action="{{ route('feedbackManagerSelfPerception.store') }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $id }}">
                                                                <div class="col-12">
                                                                    <textarea class="mt-3 form-control" id="percepcao" name="percepcao" placeholder="Descreva aqui a sua auto percepção"
                                                                        rows="6" required></textarea>
                                                                </div>
                                                                <div class="mt-4 col-12">
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Enviar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
                                @if($supervisor == 'N')                           
                                    @if($feedbackManagerCheck == 'S')  
                                        <button type="button" class="text-black align-middle btn fw-bold rounded-2 " style="background-color:#f6bf35 ;">
                                            Feedback Aceito <i class="fa-solid fa-user-check"></i>
                                        </button>
                                    @else 
                                      @if ($feedbackSelfPerceptionConfirmation == 'S')
                                        <button type="button" class="text-white align-middle btn btn-danger fw-bold rounded-2 " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            Aceita o feedback <i class="fa-solid fa-question"></i>
                                        </button>
                                       @else 
                                          <button type="button" class="text-white align-middle btn btn-danger fw-bold rounded-2 ">
                                            Auto Percepção obrigatória <i class="fa-solid fa-x"></i>
                                        </button>
                                       @endif 
                                    @endif

                                @elseif($supervisor == 'S' and $feedbackManagerCheck == 'S')
                                         <button type="button" class="text-black align-middle btn fw-bold rounded-2 " style="background-color:#f6bf35 ;">
                                            Feedback Aceito <i class="fa-solid fa-user-check"></i>
                                        </button>
                                     @else 
                                         <button type="button" class="text-white align-middle btn btn-danger fw-bold rounded-2 ">
                                            Feedback não aceito <i class="fa-solid fa-x"></i>
                                        </button>

                                 @endif

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Confirmação do Feedback.</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <blockquote>
                                                
                                                <p>Prezado(a) Gerente,</p>
                                                <p>Gostaríamos de confirmar se você recebeu o feedback fornecido por seu supervisor durante a última revisão de desempenho. É importante assegurar que você está ciente de todas as melhorias necessárias identificadas neste feedback.</p>
                                                <p>Por favor, confirme o recebimento e a compreensão das seguintes informações:</p>
                                                <ol>
                                                    <li><strong>Feedback Recebido</strong>: Confirme que você recebeu e revisou o feedback detalhado.</li>
                                                    <li><strong>Melhorias Identificadas</strong>: Confirme que você entende todas as áreas de melhoria mencionadas.</li>
                                                    <li><strong>Plano de Ação</strong>: Confirme que está preparado para desenvolver e implementar um plano de ação para abordar essas melhorias.</li>
                                                </ol>
                                                <p>Sua confirmação é essencial para garantirmos um acompanhamento eficaz e o suporte necessário para o seu desenvolvimento profissional.</p>
                                                <p>Atenciosamente,</p>
                                                <p class="text-danger">[Promofarma]</p>
                                       </blockquote>
                                    </div>
                                    <div class="modal-footer">
                                        <form id="accept-form" action="{{route('checkFeedback.store')}}" method="POST">
                                        @csrf <!-- Token CSRF necessário para proteger contra ataques CSRF -->
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-x"></i> Fechar</button>
                                        <button type="submit" name="id" id="id" value="{{$id}}" class="btn btn-success"><i class="fa-solid fa-check"></i> Aceitar</button>
                                    </form>
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
</x-app-layout>
