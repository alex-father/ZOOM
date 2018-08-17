 <header class="main-header">
 	
	<!--=====================================
	LOGOTIPO
	======================================-->
	<a href="inicio" class="logo">
		
		

		<!-- logo normal -->

		<span class="logo-lg">
			
			<img src="vistas/img/plantilla/BANNER_PRINCIPAL.png" class="img-responsive" style="padding:10px 0px">

		</span>


      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="vistas/img/plantilla/zoom_blanco.png" class="img-responsive" style="padding:10px"></span>
      



	</a>

	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
	<nav class="navbar navbar-static-top" role="navigation">
		
		<!-- Botón de navegación -->

	 	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        	
        	<span class="sr-only">Toggle navigation</span>
      	
      	</a>

		<!-- perfil de usuario -->

		<div class="navbar-custom-menu">
				
			<ul class="nav navbar-nav">
				
				<li class="dropdown user user-menu">
					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">

					<?php

					if($_SESSION["foto"] != ""){

						echo '<img src="'.$_SESSION["foto"].'" class="user-image">';

					}else{


						echo '<img src="img/zoom_blanco.png" class="user-image">';

					}


					?>
						
						<span class="hidden-xs"><?php  echo $_SESSION["nombre"]; ?></span>

					</a>

					<!-- Dropdown-toggle -->

					<ul class="dropdown-menu">
						
<li class="user-header">
                    <?php

					if($_SESSION["foto"] != ""){

						echo '<img src="'.$_SESSION["foto"].'" class="user-image">';

					}else{


						echo '<img src="zoom_blanco.png" class="user-image">';

					}


					?>
                    
                  </li>

						<li class="user-body">
							
							<div class="pull-center">
								
								<a href="salir" class="btn btn-default btn-flat">Cerrar sesión</a>

							</div>

						</li>

					</ul>

				</li>

			</ul>

		</div>

	</nav>

 </header>