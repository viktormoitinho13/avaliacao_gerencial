<x-guest-layout>
    <section class="vh-50 my-5">
        <div class="container h-25">
            <div class="row d-flex justify-content-center align-items-center   ">
                <div class="col-lg-10 col-xl-10 ">
                    <div class="card text-black my-1 mt-5" style="border-radius: 25px;">
                        <div class="row container mt-4" style="display: flex; flex-direction:row; justify-content:center; align-items:center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 mx-auto">
                                <h3 class="text-center h2 fw-bold mb-4 mx-1 mx-md-3 mt-3">Avaliação Gerencial Promofarma

                                </h3>
                                <form class="mx-1 mx-md-5 my-auto" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <!-- Name -->
                                       <div class="container justify-end mt-4 my-4">
                                    <div
                                        class="mt-3 col-md-6 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 ">
                                        <label class="form-label " for="login">Nome Completo ou Matrícula</label>
                                        <input class="form-control form-control-lg " type="text" id="login"
                                            name="login">
                                    </div>
                                    </div>


                                    <div class="container justify-end mt-4 my-4">
                                        <div class="mt-4 col-md-6 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 ">
                                            <x-label for="password" :value="__('Sua Senha')" class="form-label" />

                                            <x-input id="password" class="form-label" type="password" name="password"
                                                required autocomplete="current-password"  class="form-control form-control-lg" />
                                        </div>
                                    </div>

                                    <div class="container justify-end mt-4 my-4">
                                        <div class="col-md-12 text-center">
                                            <x-button class="btn btn-lg btn-block btn-primary col-md-8 ">
                                                {{ __('Login') }}
                                            </x-button>
                                        </div>
                                    </div>


                                </form>
                            </div>
                            <div class="col-md-9 col-lg-6 col-xl-6 ml-5 d-flex align-items-left order-1 order-lg-2  mt-4 my-4"
                                style="width:700; height=600;">

                                <img src="{{ URL::asset('/imgs/otp-security.png') }}" class="img-fluid"
                                    alt="Sample image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
