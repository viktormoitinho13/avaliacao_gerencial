<nav class="navbar" style="background-color: #E2304E; z-index: 1000;">
  <div class="container-fluid">
    <a href="{{ route('home')}} " class="mx-3 text-white navbar-brand">
      <img src="{{URL::asset('/imgs/índice2.png')}}" class="img-fluid" class="card-img-top" height="100" width="30"> Olá, {{ strstr(Auth::user()->name ,' ',true) }}
    </a> 
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="background-color:#000;">
      <div class="offcanvas-header">
        <h3 class="text-white offcanvas-title" id="offcanvasNavbarLabel">Opções</h3>
       <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>

      </div>
      <div class="text-start offcanvas-body">
        <hr class="text-white">
        <div class="d-flex flex-column">
          <a class="text-white navbar-brand d-flex justify-content-between" style="font-size: 120%;" href="{{ route('home')}}">Home <i class="fa-solid fa-house" style="margin-left: auto;"></i></a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="text-white navbar-brand d-flex justify-content-between " style="font-size: 120%;" href="{{ route('logout') }}" 
            onclick="event.preventDefault(); this.closest('form').submit();">Sair <i class="fa-solid fa-person-walking-dashed-line-arrow-right" style="margin-left: auto;"></i></a>
          </form>
        </div>
      </div>
    </div>
  </div>
</nav>
