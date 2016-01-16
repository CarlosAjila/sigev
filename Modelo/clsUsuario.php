<?php
/*
Tipo de archivo: clase
Descripción: Clase usuario
Desarrollado por: José Ambuludí
Fecha de elaboración: 12 de Enero de 2016
Fecha de modificación: 12 de Enero de 2016
Versión: 0.1
*/
require_once("clsDatos.php");
class clsUsuario{

//Declarando datos
public $id_per;
public $id_car;
public $fot_usu;
public $nus_usu;
public $con_usu;
public $ema_usu;
public $ffc_usu;
public $est_usu;

//Array para obtener el listado de cargos
public $arreglo = array();

	//Constructor
	public function __construct($id_per,$id_car,$fot_usu,$nus_usu,$con_usu,$ema_usu,$ffc_usu,$est_usu){
		$this->id_per = $id_per;
		$this->id_car = $id_car;
		$this->fot_usu = $fot_usu;
		$this->nus_usu = $nus_usu;
		$this->con_usu = $con_usu;
		$this->ema_usu = $ema_usu;
		$this->ffc_usu = $ffc_usu;
		$this->est_usu = $est_usu;
	}
	
	//Destructor
	public function __destruct(){
	}
	
	//Getters
	public function get_id_per(){
		return $this->id_per;
	}
	public function get_id_car(){
		return $this->id_car;
	}
	public function get_fot_usu(){
		return $this->fot_usu;
	}
	public function get_nus_usu(){
		return $this->nus_usu;
	}
	public function get_con_usu(){
		return $this->con_usu;
	}
	public function get_ema_usu(){
		return $this->ema_usu;
	}
	public function get_ffc_usu(){
		return $this->ffc_usu;
	}
	public function get_est_usu(){
		return $this->est_usu;
	}
		
	//Función para buscar un usuario
	public function buscar(){
		$encontro = false;
		$objDatos = new clsDatos();
		$sql = "SELECT * FROM usuario WHERE id_per='$this->id_per'";
		$datos_desordenados = $objDatos->consulta($sql);
		
		if($columna = $objDatos->arreglos($datos_desordenados))
		{
			$this->id_per = $columna['id_per'];
			$this->id_car = $columna['id_car'];
			$this->fot_usu = $columna['fot_usu'];
			$this->nus_usu = $columna['nus_usu'];
			$this->con_usu = $columna['con_usu'];
			$this->ema_usu = $columna['ema_usu'];
			$this->ffc_usu = $columna['ffc_usu'];
			$this->est_usu = $columna['est_usu'];
			$encontro = true;
		}
		
		//Cerrar la consulta
		$objDatos->cerrar_consulta($datos_desordenados);
		$objDatos->crerrarconexion();
		return $encontro;
	}
	
	//Insertar usuario
	public function insertar($id_per,$id_car,$fot_usu,$nus_usu,$con_usu,$ema_usu,$ffc_usu,$est_usu){
		$objDatos = new clsDatos();
		$sql = "INSERT INTO usuario(id_per,id_car,fot_usu,nus_usu,con_usu,ema_usu,ffc_usu,est_usu) VALUES('$id_per','$id_car','$fot_usu','$nus_usu','$con_usu','$ema_usu','$ffc_usu','$est_usu')";
		$objDatos->ejecutar($sql);
		$objDatos->crerrarconexion();
	}
	
	//Modificar datos de usuario
	public function modificar(){
		$objDatos = new clsDatos();
		$sql = "UPDATE usuario SET(id_per='$this->id_per',id_car='$this->id_car',fot_usu='$this->fot_usu',nus_usu='$this->nus_usu',con_usu='$this->con_usu',ema_usu='$this->ema_usu',ffc_usu='$this->ffc_usu',est_usu='$this->est_usu')";
		$objDatos->ejecutar($sql);
		$objDatos->crerrarconexion();
	}
	
	//Dar de baja a un usuario
	public function dar_baja($id_per){
		$objDatos = new clsDatos();
		$sql = "UPDATE usuario SET est_usu='I' WHERE id_per='$id_per'";
		$objDatos->ejecutar($sql);
		$objDatos->crerrarconexion();
	}
	
	/****Sección del administrador****/
	//Modificar cargo y fecha de fin de contrato de usuario
	public function modificar_usuario($id_car,$id_per){
		$objDatos = new clsDatos();
		$sql = "UPDATE usuario SET id_car='$id_car' WHERE id_per='$id_per'";
		$objDatos->ejecutar($sql);
		$objDatos->crerrarconexion();
	}
	
	//Listar cargos
	public function listar_cargo(){
		$objDatos= new clsDatos();
		$sql="SELECT * FROM cargo WHERE est_car='A'";
		$datos_desordenados = $objDatos->consulta($sql);
		while($columna = $objDatos->arreglos($datos_desordenados))
		{
			$this->arreglo [] = array("id_car"=>$columna['id_car'],
									  "nom_car"=>$columna['nom_car']);
		}
		return($this->arreglo);
	}
}	
?>