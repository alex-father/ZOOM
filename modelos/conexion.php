<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost:33065;dbname=zoom",
			            "root",
			            "");

		$link->exec("set names utf8");

		return $link;

	}

}