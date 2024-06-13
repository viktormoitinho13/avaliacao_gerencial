<x-app-layout>
    <div class="mt-5 mb-4 d-flex justify-content-center" >
        <div class=" col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-5">
            <div class="mx-auto mt-4 mb-4 bg-white rounded shadow card "
                style="border-color: #ff0000; background-color:#e3f0ff1a">
                <div class="card-body ">
                    <h1 class="mt-4 text-center title text-dark" style="font-size: 30px;">FeedBack da avaliação gerencial</h1>
                    <form action="{{route('pdiFormAnswersController.store')}}" method="POST">
                          @csrf
                        <div class="container mt-5">
                            <div class="d-flex justify-content-center">
                                <div class="mb-3 row">
                                    <div class="mt-2 col-sm-12 col-md-6">
                                        <label for="gerente">Gerente</label>
                                        <select id="gerente" name="gerente" class="form-control" required>
                                            @foreach ($gerentes as $gerente)
                                                <option value="{{ $gerente->AG_LOJA }}|{{ $gerente->GERENTE }}">
                                                    {{ $gerente->gerente_atual }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-2 col-sm-12 col-md-6">
                                        <label for="data">Data</label>
                                        <input type="text" name="dataFeedback" id="dataFeedback" value="{{ $dataAtual }}"  placeholder="{{ $dataAtual }}"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                        <div class="mt-2 form-group col-10">
                            <fieldset class="p-2 border border-danger">
                                <legend class="float-none w-auto p-2">Objetivo Principal</legend>
                                <div class="mx-4 mb-2">
                                        <textarea class="form-control col-4" id="objetivo" name="objetivo" rows="5" required maxlength="255"></textarea>
                                    </div>
                            </fieldset>
                        </div> </div>
                         <div class="d-flex justify-content-center">
                        <div class="mt-2 form-group col-10">
                            <fieldset class="p-2 border border-danger">
                                <legend class="float-none w-auto p-2 mt-4 mb-2 d-flex align-items-center flex-nowrap">
                                    Habilidades a Desenvolver
                                    <input type="number" id="qtddesenvolver" class="mx-2 form-control form-control-sm"
                                          style="width: 70px;"
                                        placeholder="Qtd" >
                                </legend>
                                <div class="desenvolverContainer">
                                   <div class="mx-4 mb-2">
                                        <textarea class="form-control" id="desenvolver1" name="desenvolver1" rows="2" required maxlength="100"> </textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div></div>
                        
                         <div class="d-flex justify-content-center">
                        <div class="mt-2 form-group col-10">
                            <fieldset class="p-1 border border-danger">
                                <legend class="float-none w-auto p-2 mt-4 mb-2 d-flex align-items-center flex-nowrap">
                                    Habilidades a Reconhecer
                                    <input type="number" id="qtdreconhecer"   class="mx-2 form-control form-control-sm"
                                         style="width: 70px;"
                                        placeholder="Qtd">
                                </legend>
                                <div class="reconhecerContainer">
                                   <div class="mx-4 mb-2">
                                        <textarea class="form-control" id="reconhecer1" name="reconhecer1" rows="2" required maxlength="100"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div></div>
                          <div class="d-flex justify-content-center">
                        <div class="mt-2 form-group col-10">
                             <fieldset class="border border-danger">
                                <legend class="float-none w-auto p-2">Anotações</legend>
                                <div class="mx-2 mb-2 form-group">
                                    <div class="mx-4 mb-3">
                                        <textarea class="form-control" id="anotacao" name="anotacao" rows="5" required maxlength="255"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div> </div>
                         <div class="d-flex justify-content-center">
                        <div class="mt-2 form-group col-10">
                            <fieldset class="p-2 border border-danger">
                                <legend class="float-none w-auto p-2 mt-4 mb-4 d-flex align-items-center flex-nowrap">
                                    Planos de Ações
                                    <input type="number" id="qtdacoes" class="mx-2 form-control form-control-sm"
                                        style="width: 70px;"
                                        placeholder="Qtd">
                                </legend>
                                <div id="planosContainer">
                                    <div class="p-2 mx-4 mb-4 border">
                                        <div class="mx-4 mt-2 d-flex justify-content-left">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="dataDe">De.</label>
                                                    <input type="date" id="dataDe1" name="dataDe1" class="mt-2 form-control" required>
                                                </div>
                                                <div class="col-6">
                                                    <label for="dataAte">Até.</label>
                                                    <input type="date" id="dataAte1" name="dataAte1" class="mt-2 form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container mt-1 ">
                                            <div class="mx-2 mb-2 form-group">
                                                <div class="row">
                                                    <div class="mt-4 col-6">
                                                        <label class="mx-1">Ações</label>
                                                        <textarea class="form-control" id="acao1"  name="acao1" rows="1" required maxlength="100"></textarea>
                                                    </div>
                                                    <div class="mt-4 col-6">
                                                      <label class="mx-1">Entrega</label>
                                                        <textarea class="form-control" id="entrega1"  name="entrega1" rows="1"  maxlength="100"></textarea>
                                                    </div>
                                                    <div class="mt-4 col-6">
                                                      <label class="mx-1">Recursos</label>
                                                        <textarea class="form-control" id="recurso1" name="recurso1" rows="1"  maxlength="100"></textarea>
                                                    </div>
                                                   <div class="mt-4 col-6">
                                                    <label class="mx-1">Status</label>
                                                    <select class="status form-control" id="status1" name="status1"  maxlength="100"> 
                                                        <option value="andamento">Em andamento</option>
                                                        <option value="fazer">A fazer</option>
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div> </div>
                        <div class="d-flex">
                        <button type="submit" class="mx-auto mt-3 ml-2 btn btn-lg btn-primary">
                          Salvar o Feedback  <i class="fa-regular fa-floppy-disk"></i>
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 <script>
        const inputs = document.querySelectorAll('input[type="number"]');
        inputs.forEach(input => {
            input.addEventListener('input', function (e) {
                const value = e.target.value;
                if (value < 1) {
                    e.target.value = 1;
                }
            });
            input.addEventListener('blur', function (e) {
                const value = e.target.value;
                if (value < 1) {
                    e.target.value = 1;
                }
            });
        });
    </script>
<script>
    document.getElementById('qtddesenvolver').addEventListener('change', function() {
        const quantidadeDesenvolver = parseInt(this.value);
        const container = document.querySelector(
        '.desenvolverContainer'); // Corrigido para selecionar a classe 'desenvolverContainer'
        container.innerHTML = ''; // Limpar o conteúdo do container
        for (let i = 1; i <= quantidadeDesenvolver; i++) {
            container.innerHTML += `
                 <div class="mx-4 mb-4">
                <textarea class="form-control" id="desenvolver${i}"  name="desenvolver${i}" rows="3"></textarea required>
          </div>
        `;
        }
    });
</script>
<script>
    document.getElementById('qtdreconhecer').addEventListener('change', function() {
        const quantidadereconhecer = parseInt(this.value);
        const container = document.querySelector(
        '.reconhecerContainer'); // Corrigido para selecionar a classe 'desenvolverContainer'
        container.innerHTML = ''; // Limpar o conteúdo do container
        for (let i = 1; i <= quantidadereconhecer; i++) {
            container.innerHTML += `
           <div class="mx-4 mb-4">
                <textarea class="form-control" id="reconhecer${i}" name="reconhecer${i}" rows="3" required></textarea>
          </div>`;
        }
    });
</script>
<script>
    document.getElementById('qtdacoes').addEventListener('change', function() {
        const quantidade = parseInt(this.value);
        const container = document.getElementById('planosContainer');
        container.innerHTML = ''; // Limpa o container
        for (let i = 1; i <= quantidade; i++) {
            const fieldset = document.createElement('div');
            fieldset.className = 'p-2 mx-4 mb-4 border';
            fieldset.innerHTML = `
                                <div class="mx-4 mt-2 d-flex justify-content-left">
                                    <div class="row">
                                        <div class="col-6">
                                                    <label for="dataDe">De.</label>
                                                    <input type="date" id="dataDe${i}" name="dataDe${i}" class="mt-2 form-control" required>
                                                </div>
                                                <div class="col-6">
                                                    <label for="dataAte">Até.</label>
                                                    <input type="date" id="dataAte${i}" name="dataAte${i}" class="mt-2 form-control" required>
                                                </div>
                                    </div>
                                </div>
                                <div class="container mt-1 mb-4" id="planosContainer">
                                    <div class="mx-2 mb-2 form-group">
                                        <div class="row">
                                           <div class="mt-4 col-6">
                                                        <label class="mx-1">Ações</label>
                                                        <textarea class="form-control" id="acao${i}"  name="acao${i}" rows="1" required></textarea>
                                                    </div>
                                                    <div class="mt-4 col-6">
                                                      <label class="mx-1">Entrega</label>
                                                        <textarea class="form-control" id="entrega${i}"  name="entrega${i}" rows="1" required></textarea>
                                                    </div>
                                                    <div class="mt-4 col-6">
                                                      <label class="mx-1">Recursos</label>
                                                        <textarea class="form-control" id="recurso${i}" name="recurso${i}" rows="1" required></textarea>
                                                    </div>

                                                    <div class="mt-4 col-6">
                                                      <label class="mx-1">Status</label>
                                                       <select class="status form-control" id="status1" name="status${i}" required> 
                                                        <option value="andamento">Em andamento</option>
                                                        <option value="fazer">A fazer</option>
                                                    </select>
                                                    </div>
                                        </div>
                                    </div>
                                </div>`;
            container.appendChild(fieldset);
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dataDe = document.getElementById('dataDe');
        var dataAte = document.getElementById('dataAte');
        var dataAtual = new Date().toISOString().split('T')[0];
        dataDe.min = dataAtual;
        dataDe.addEventListener('input', function() {
            dataAte.min = dataDe.value;
            if (dataAte.value < dataDe.value) {
                dataAte.value = dataDe.value;
            }
        });
        dataAte.addEventListener('input', function() {
            if (dataAte.value < dataDe.value) {
                dataAte.value = dataDe.value;
            }
        });
    });
</script>
