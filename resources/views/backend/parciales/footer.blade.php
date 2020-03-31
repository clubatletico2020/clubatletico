<footer class="main-footer">
 	<div class="row">
 		<div class="col-8">
 			Desarrollado por <a href="http://cento.cl">CENTO - Servicios Informaticos</a>
 		</div>
 		<div class=" col-4 text-right">
 			<form action="{{ route('logout') }}" method="POST">
                @csrf
 				<button type="submit" class="btn btn-sm btn-outline-danger">Cerrar Sesión</button>
            </form> 
 		</div> 		
 	</div>
    
 </footer>