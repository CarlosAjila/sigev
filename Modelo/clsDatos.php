<?php
/*
Tipo de archivo: Clase
Descripción: Clase para la conexión a la base de datos
Desarrollado por: José Ambuludí
Fecha de elaboración: 10 de Enero de 2016
Fecha de modificación: 10 de Enero de 2016
Versión: 0.1
*/
class clsDatos{
public $conexion;
public $id;
	//Constructor
	public function __construct(){
		$servidor="localhost";
		$usuario="root";
		$clave="";
		$base="bd_sigev";
		$this->conexion=mysqli_connect($servidor,$usuario,$clave);
		mysqli_select_db($this->conexion,$base);
	}
	
	//Destructor
	public function __destruct(){
	}
	
	//Ejecutar query
	public function consulta($sql){
		$resultado=mysqli_query($this->conexion,$sql);
		return $resultado;
	}
	
	//Cerrar consultas
	public function cerrar_consulta($datos){
		mysqli_free_result($datos);
	}
	
	//Devolución de array
	public function arreglos($datos){
		$arreglo=mysqli_fetch_array($datos);
		return $arreglo;
	}
	
	//Función para insertar, modificar y eliminar
	public function ejecutar($sql){
		mysqli_query($this->conexion, $sql);
		$id=mysqli_insert_id($this->conexion);
		return($id);
	}
	
	//Cerrar la conexion
	public function crerrarconexion(){
		mysqli_close($this->conexion);
	}
	
}
?>