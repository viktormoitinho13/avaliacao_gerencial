<x-guest-layout>
    <section style="margin-top: 9%;">
        <div class="container h-50">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-5 col-xl-5">
                    <div class="my-1 mt-3 text-black card" style="border-radius: 25px; border-color: #E2304E;">
                        <div class="container mt-3 text-center">
                            <div class="row">
                                <div class="align-middle col-12">
                                    <div class="mt-5 mb-2 text-center">
                                         <div class="d-flex justify-content-center align-items-center">
                                            <img src="{{ URL::asset('/imgs/índice2.png') }}" alt="Logo" style="max-height: 40px; margin-right: 10px;">
                                            <h2 class="mt-2"><b>Avaliação Gerencial</b></h2>
                                        </div>
                                        <h5 style="color:#BFB9AD;" class="mt-3">Faça o login aqui para acessar sua conta.</h5>
                                    </div>
                                    <form class="mx-auto mt-5 mb-5" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <!-- Número da Matrícula -->
                                        <div class="mb-3 d-flex justify-content-center">
                                            <div class="col-6">
                                                <label for="login" class="text-start w-100">Número da Matrícula</label>
                                                <input class="mt-1 form-control form-control-lg" type="text" id="login" name="login">
                                            </div>
                                        </div>
                                        <!-- Senha -->
                                        <div class="mt-3 mb-3 d-flex justify-content-center">
                                            <div class="col-6">
                                                <label for="password" class="text-start w-100">Sua Senha</label>
                                                <x-input id="password" class="mt-1 form-control form-control-lg" type="password" name="password" required autocomplete="current-password" onpaste="return false" ondrop="return false" />
                                            </div>
                                        </div>
                                        <!-- Botão de Login -->
                                        <div class="mt-5 d-flex justify-content-center">
                                            <div class="text-center">
                                                <x-button class="btn btn-lg btn-block btn-danger">
                                                    {{ __('Login') }}
                                                </x-button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
