<nav x-data="{ open: false }" class="navbar navbar-expand-sm bg-primary navbar-dark">
     <a class="navbar-brand mx-3" href="{{route('dashboard')}}">Logo</a>
  
 <div class="collapse navbar-collapse justify-content-end mx-3" id="navbarSupportedContent">
		  <ul class="navbar-nav ">
			<li class="nav-item">
			   <form method="POST" action="{{ route('logout') }}">
                    @csrf
                 <a class="navbar-brand mx-3" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Sair') }}</a>
                   
                </form>
			</li>			
		  </ul>		  
		</div>
  
</nav>
