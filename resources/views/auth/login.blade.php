<x-guest-layout>
    <x-auth-card>
<section class="vh-100">
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
               

                   <label for="login">Email / Nome Completo / Usuário / Matrícula</label>

                  <input type="text" id="login" name="login"><br><br>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="form-label" type="password" name="password" required
                    autocomplete="current-password" />
            </div>
          
            <div class="flex items-center justify-left mt-6">
               
                <x-button class="btn btn-primary btn-floating mx-1">
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