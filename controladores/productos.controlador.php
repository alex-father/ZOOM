<?php
class ControladorProductos{
	/*=============================================
	
	static public function ctrIngresoProducto(){
		if(isset($_POST["ingUsuario"])){
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){
				
				$tabla = "usuarios";
				$item = "usuario";
				$valor = $_POST["ingUsuario"];
				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
				if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $_POST["ingPassword"]){
					if($respuesta["estado"] == 1){
						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["perfil"] = $respuesta["perfil"];
						/*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
				
						date_default_timezone_set('America/Bogota');
						$fecha = date('Y-m-d');
						$hora = date('H:i:s');
						$fechaActual = $fecha.' '.$hora;
						$item1 = "ultimo_login";
						$valor1 = $fechaActual;
						$item2 = "id";
						$valor2 = $respuesta["id"];
						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
						if($ultimoLogin == "ok"){
							echo '<script>
								window.location = "inicio";
							</script>';
						}				
						
					}else{
						echo '<br>
							<div class="alert alert-danger">El usuario aún no está activado</div>';
					}		
				}else{
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
				}
			}	
		}
	}
	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/
	static public function ctrCrearProducto(){
		if(isset($_POST["nuevoProducto"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"])){
			   	/*=============================================
				VALIDAR IMAGEN
				=============================================*/
				$ruta = "";
				if(isset($_FILES["nuevaFoto"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/
					$directorio = "vistas/img/usuarios/".$_POST["nuevoProducto"];
					mkdir($directorio, 0755);
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["nuevoProducto"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}
					if($_FILES["nuevaFoto"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["nuevoProducto"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}
				}
				$tabla = "productos";
				$datos = array("nombre" => $_POST["nuevoNombre"],
					           "descripcion" => $_POST["nuevaDescripcion"],
					           "foto"=>$ruta);
				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);
			
				if($respuesta == "ok"){
					echo '<script>
					swal({
						type: "success",
						title: "¡El producto ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
						
							window.location = "productos";
						}
					});
				
					</script>';
				}	
			}else{
				echo '<script>
					swal({
						type: "error",
						title: "¡El producto no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
						
							window.location = "productos";
						}
					});
				
				</script>';
			}
		}
	}
	/*=============================================
	MOSTRAR USUARIO
	=============================================*/
	static public function ctrMostrarProductos($item, $valor){
		$tabla = "productos";
		$respuesta = ModeloProductos::MdlMostrarProductos($tabla, $item, $valor);
		return $respuesta;
	}
	
	/*=============================================
	BORRAR USUARIO
	=============================================*/
	static public function ctrBorrarProducto(){
		if(isset($_GET["idProducto"])){
			$tabla ="productos";
			$datos = $_GET["idProducto"];
			if($_GET["fotoProducto"] != ""){
				unlink($_GET["fotoProducto"]);
				rmdir('vistas/img/usuarios/'.$_GET["producto"]);
			}
			$respuesta = ModeloProductos::mdlBorrarProducto($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {
								window.location = "productos";
								}
							})
				</script>';
			}		
		}
	}
}