<x-app-layout>
    <div class="mt-5 d-flex justify-content-center">
        <div class="col col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-5" style="margin-top: 3%;">
            <div class="mx-4 mt-4 mb-4 bg-white rounded shadow card" style="border-color: #ff0000; background-color:#e3f0ff1a">
                <div class="card-body">
                    <form id="liberaQuestao"  method="GET" action="{{ route('authorizeQuestionController') }}">
                        <h1 class="mx-5 mt-4 text-center">Liberação de questões</h1>
                        <p class="mx-5 text-center fst-italic">Aqui você pode liberar as questões mensais para as lojas</p>

                        <div class="mx-5 mt-5 mb-5 row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label fs-6">Gerente</label>
                            <div class="col-sm-10" id="dadosLojas" data-dados="{{ json_encode($lojasSupervisionadas) }}">
                                <select class="form-select w-75" id="gerente" name="gerente" required>
                                        <option value="" selected >Selecione</option>
                                    @foreach ($lojasSupervisionadas as $lojaSupervisionada => $CLASSIFICACAO)
                                        <option value="{{ $lojaSupervisionada }}">
                                            {{ $lojaSupervisionada }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <fieldset class="mx-5 mt-5 mb-3 row">
                            <legend class="pt-0 col-form-label col-sm-2 fs-7">Categoria</legend>
                            <div class="col-sm-10" id="categorias">
                                <!-- Conteúdo das categorias será inserido dinamicamente aqui -->
                            </div>
                        </fieldset>

                        <a href="{{ route('ReleaseMonthlyQuestions.index') }}" class="mt-5 ml-4 text-white btn btn-lg btn-danger">
                            <i class="fas fa-trash"></i> Limpar
                        </a>

                        <button type="submit" class="mt-5 ml-4 btn btn-lg btn-primary">
                            <i class="fas fa-thumbs-up"></i> Autorizar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const select = document.querySelector('#gerente');
        const dados = document.querySelector('#dadosLojas');
        const categorias = document.querySelector('#categorias');

        const dadosDecode = JSON.parse(dados.getAttribute('data-dados'));

        select.addEventListener('change', function(event) {
            const value = event.target.value;
            let div = [];
            const DadosSelecionados = dadosDecode[value];

            if (DadosSelecionados == null) {
                return;
            }

            Object.entries(DadosSelecionados).forEach((valor) => {
                const [id, name] = valor;
                div.push(`
                    <div class="text-left form-check">
                        <input class="form-check-input" type="checkbox" id="classificacao${id}" name="classificacoes[]" value="${id}">
                        <label class="form-check-label" for="classificacao${id}">
                            <h5>${name}</h5>
                        </label>
                    </div>
                `);
            });

            categorias.innerHTML = div.join("");
        });
    </script>
</x-app-layout>
