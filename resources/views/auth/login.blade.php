<x-guest-layout>
    <section class="vh-75 my-5">
        <div class="container h-50">
            <div class="row d-flex justify-content-center align-items-center ">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black my-4 mt-5" style="border-radius: 25px;">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 mx-auto">
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>
                                 <form class="mx-1 mx-md-4 my-auto" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <!-- Name -->
                                    <div class="mt-4 col-md-6 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 ">
                                        <label class="form-label" for="login">Nome Completo ou
                                                    Matrícula</label>
                                        <input class="form-control form-control-lg" type="text"
                                                    id="login" name="login">
                                    </div>

                                 
                                  
                                    <div class="mt-4 col-md-6 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 ">
                                        <x-label for="password" :value="__('Sua Senha')" class="form-label" />

                                                <x-input id="password" class="form-label" type="password"
                                                    name="password" required autocomplete="current-password"
                                                    class="form-control form-control-lg" />
                                    </div>
                                  
                                  
                                    <div class="flex items-center justify-end mt-4 my-4">
                                        <x-button class="btn btn-lg btn-block btn-primary col-md-6 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                    {{ __('Login') }}
                                                </x-button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-9 col-lg-6 col-xl-5 ml-5 d-flex align-items-center order-1 order-lg-2" style="width:500; height=600;">
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
