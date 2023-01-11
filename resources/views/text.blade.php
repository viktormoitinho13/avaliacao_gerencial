<x-app-layout>
    <div
        class="container-fluid col-md-6 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-6 offset-md-3 my-4 mx-auto mt-4">
     
        <form action="{{ route('respostas.store', ['id' => $id]) }}" method="POST">
            @csrf
            
                <div class="card w-100 mx-auto mb-1 mt-4 shadow-sm  bg-white rounded "
                    style="border-color: #b1d5ff; background-color:#e3f0ff1a">
                  
                </div>
            
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <button class="btn btn-lg btn-block col-4 offset-md-3 my-4 mx-auto text-center"
                            style="background-color:#6b9dd8; color:white;"><i class="fas fa-share"
                                aria-hidden="true">Enviar</i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
