<nav x-data="{ open: false }" class="navbar navbar-expand-sm navbar-light"style="background-color: #6B9DD8;">
     <a href="/" class="navbar-brand mx-3"> <img src="{{URL::asset('/imgs/índice2.png')}}"  class="img-fluid"  class="card-img-top" height="100" width="40"></a> 
  
 <div class="collapse navbar-collapse justify-content-end mx-3" id="navbarSupportedContent">
		  <ul class="navbar-nav ">
			<li class="nav-item">
			   <form method="POST" action="{{ route('logout') }}">
                    @csrf
                 <a class="navbar-brand text-light mx-3" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"> <img src="{{URL::asset('/imgs/icons8-saída-de-emergência-50.png')}}" alt="profile Pic"   class="img-fluid" alt="Sample image"  class="card-img-top" height="100" width="40"></a>
                   
                </form>
			</li>			
		  </ul>		  
		</div>
  
</nav>
