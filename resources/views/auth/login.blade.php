<x-guest-layout>
    <x-auth-card>
<section class="vh-100 mt-5">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
     
       <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                 <!-- Email input -->
         <div class="col-md-6 ">
                  <label class="form-label" for="login">Nome Completo ou  Matrícula</label>
                  <input class="form-control form-control-lg" type="text" id="login" name="login"><br><br>
            </div>

            <!-- Password -->
            <div class="col-md-6 mb-4">
                <x-label for="password" :value="__('Password')" class="form-label"/>

                <x-input id="password" class="form-label" type="password" name="password" required
                    autocomplete="current-password" class="form-control form-control-lg" />
            </div>
          
            <div class="flex items-center justify-left mt-1">
               
                <x-button class="btn btn-lg btn-block btn-primary col-md-6 mb-6">
                    {{ __('Login') }}
                </x-button>
            </div>
        </form>
      </div>
    </div>
  </div>
 
</section>
    </x-auth-card>
</x-guest-layout>