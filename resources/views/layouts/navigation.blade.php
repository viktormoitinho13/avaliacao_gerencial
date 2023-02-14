
<nav x-data="{ open: false }" class="navbar navbar-expand-lg navbar-dark " style="background-color: #6B9DD8;">
  <div class="container-fluid">
    <a href="/" class="navbar-brand mx-3"> <img src="{{URL::asset('/imgs/índice2.png')}}"  class="img-fluid"  class="card-img-top" height="100" width="30"> Olá, {{ strstr(Auth::user()->name ,' ',true) }}</a> 
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       
      </ul>
      <span class="navbar-text">
         <form method="POST" action="{{ route('logout') }}">
                    @csrf

                 <a class="navbar-brand text-light mx-3" style="font-size: 150%; font-family:-apple-system, Roboto;" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"> Sair</a>
                   
                </form>
      </span>
    </div>
  </div>
</nav>
