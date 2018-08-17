<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idClientes;

	public function ajaxEditarClientes(){

		$item = "id";
		$valor = $this->idClientes;

		$respuesta = ControladorClientess::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR USUARIO
	=============================================*/	

	public $activarClientes;
	public $activarId;


	public function ajaxActivarClientes(){

		$tabla = "clientes";

		$item1 = "estado";
		$valor1 = $this->activarClientes;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloClientes::mdlActualizarClientes($tabla, $item1, $valor1, $item2, $valor2);

	}

	/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/	

	public $validarClientes;

	public function ajaxValidarClientes(){

		$item = "clientes";
		$valor = $this->validarClientes;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idClientes"])){

	$editar = new AjaxClientes();
	$editar -> idClientes = $_POST["idClientes"];
	$editar -> ajaxEditarClientes();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["activarClientes"])){

	$activarClientes = new AjaxClientes();
	$activarClientes -> activarClientes = $_POST["activarClientes"];
	$activarClientes -> activarId = $_POST["activarId"];
	$activarClientes -> ajaxActivarClientes();

}

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset( $_POST["validarClientes"])){

	$valClientes = new AjaxClientes();
	$valClientes -> validarClientes = $_POST["Clientes"];
	$valClientes -> ajaxValidarClientes();

}