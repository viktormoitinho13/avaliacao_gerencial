<div class="mx-auto my-auto container-fluid center-block">
    <div class="mt-5 row">
        <div class="mt-1 d-flex justify-content-center">
            <div class="col align-self-center col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-8">
                <div class="mb-5 d-flex justify-content-center">
                    <div class="col align-self-center col-4 col-sm-8 col-md-8 col-lg-6 col-xl-6 col-xxl-6">
                        <form class="my-2 mt-5 my-lg-0 d-flex" id="buscaLoja" method="GET" action="{{ route($route) }}">

                            <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 g-4">
                                <div class="input-group">
                                    <input class="px-2 mx-2 mr-2 form-control form-control-sm" type="text"
                                           id="loja" name="loja" placeholder="Loja"
                                           style="color:#E2304E; border-color:#f3a9a9;border-radius:20px"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                    <select id="mes" name="mes" class="px-2 mr-2 form-control btn"
                                            style="color:#E2304E; border-color:#f3a9a9;border-radius:20px">
                                        <option value="" style="color:#000000;">Mês</option>
                                    </select>
                                    <select id="ano" name="ano" class="px-2 mx-2 form-control btn"
                                            style="color:#E2304E; border-color:#f3a9a9;border-radius:20px">
                                        <option value="">Ano</option>
                                    </select>
                                </div>

                                <div class="input-group justify-content-center">
                                    <div class="mx-1 input-group-append">
                                        <button class="px-2 btn" style="color:#468ddd;border-color:#d5e9ff;"
                                                type="submit">
                                            <i class="fas fa-search" aria-hidden="true"></i> Buscar
                                        </button>
                                        <button class="px-2 btn" style="color:#dd4646;border-color:#ffd5d5;"
                                                type="submit">
                                            <i class="fa fa-refresh" aria-hidden="true"></i> <a
                                                style="text-decoration:none; color:#dd4646"
                                                href="{{ route($route) }}">Limpar </a>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const meses = [
        "Janeiro", "Fevereiro", "Março", "Abril",
        "Maio", "Junho", "Julho", "Agosto",
        "Setembro", "Outubro", "Novembro", "Dezembro"
    ];

    function preencherMeses() {
        const selectMes = document.getElementById("mes");
        const selectAno = document.getElementById("ano");
        meses.forEach((mes, index) => {
            const optionMes = document.createElement("option");
            optionMes.value = index + 1; // O valor é o índice + 1 (janeiro é 1, fevereiro é 2, etc.)
            optionMes.textContent = mes;
            selectMes.appendChild(optionMes);
        });
        const anoAtual = new Date().getFullYear();
        for (let ano = 2023; ano <= anoAtual; ano++) {
            const optionAno = document.createElement("option");
            optionAno.value = ano;
            optionAno.textContent = ano;
            selectAno.appendChild(optionAno);
        }
    }

    window.onload = preencherMeses;
</script>
