<nav x-data="{ open: false }" class="navbar navbar-expand-sm navbar-dark"style="background-color: #6B9DD8;">
     <a href="/" class="navbar-brand mx-3"> <img src="{{URL::asset('/imgs/índice2.png')}}"  class="img-fluid"  class="card-img-top" height="100" width="30"> Olá, {{ Auth::user()->name }}</a> 
  
 <div class="collapse navbar-collapse justify-content-end mx-3" id="navbarSupportedContent">
		  <ul class="navbar-nav ">
			<li class="nav-item">
			   <form method="POST" action="{{ route('logout') }}">
                    @csrf
                 <a class="navbar-brand text-light mx-3" style="font-size: 150%; font-family:-apple-system, Roboto;" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"> Sair</a>
                   
                </form>
			</li>			
		  </ul>		  
		</div>
  
</nav>
