<?php
require_once("clsDatos.php");
class clsPersona{

//Declarando datos
public $id_car;
public $ced_usu;
public $pno_usu;
public $sno_usu;
public $pap_usu;
public $sap_usu;
public $fna_usu;
public $cel_usu;
public $tel_usu;
public $fot_usu;
public $nus_usu;
public $con_usu;
public $ema_usu;
public $ffc_usu;
public $est_usu;

	//Constructor
	public function __construct($id_car,$ced_usu,$pno_usu,$sno_usu,$pap_usu,$sap_usu,$fna_usu,$cel_usu,$tel_usu,$fot_usu,$nus_usu,$con_usu,$ema_usu,$ffc_usu,$est_usu){
		$this->id_car = $id_car;
		$this->ced_usu = $ced_usu;
		$this->pno_usu = $pno_usu;
		$this->sno_usu = $sno_usu;
		$this->pap_usu = $pap_usu;
		$this->sap_usu = $sap_usu;
		$this->fna_usu = $fna_usu;
		$this->cel_usu = $cel_usu;
		$this->tel_usu = $tel_usu;
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
	public function get_id_car(){
		return $this->id_car;
	}
	public function get_ced_usu(){
		return $this->ced_usu;
	}
	public function get_pno_usu(){
		return $this->pno_usu;
	}
	public function get_sno_usu(){
		return $this->sno_usu;
	}
	public function get_pap_usu(){
		return $this->pap_usu;
	}
	public function get_sap_usu(){
		return $this->sap_usu;
	}
	public function get_fna_usu(){
		return $this->fna_usu;
	}
	public function get_cel_usu(){
		return $this->cel_usu;
	}
	public function get_tel_usu(){
		return $this->tel_usu;
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
	
	//Función para buscar usuarios
	public function buscar(){
		$encontro = false;
		$objDatos = new clsDatos();
		$sql = "SELECT * FROM usuario WHERE ced_usu='$this->ced_usu'";
		$datos_desordenados = $objDatos->consulta($sql);
		
		if($columna = $objDatos->arreglos($datos_desordenados))
		{
			$this->id_car = $columna['id_car'];
			$this->ced_usu = $columna['ced_usu'];
			$this->pno_usu = $columna['pno_usu'];
			$this->sno_usu = $columna['sno_usu'];
			$this->pap_usu = $columna['pap_usu'];
			$this->sap_usu = $columna['sap_usu'];
			$this->fna_usu = $columna['fna_usu'];
			$this->cel_usu = $columna['cel_usu'];
			$this->tel_usu = $columna['tel_usu'];
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
	public function insertar(){
		$objDatos = new clsDatos();
		$sql = "INSERT INTO usuario(id_car,ced_usu,pno_usu,sno_usu,pap_usu,sap_usu,fna_usu,cel_usu,tel_usu,fot_usu,nus_usu,con_usu,ema_usu,ffc_usu,est_usu) VALUES('$this->id_car','$this->ced_usu','$this->pno_usu','$this->sno_usu','$this->pap_usu','$this->sap_usu','$this->fna_usu','$this->cel_usu','$this->tel_usu','$this->fot_usu','$this->nus_usu','$this->con_usu','$this->ema_usu','$this->ffc_usu','$this->est_usu')";
		$objDatos->ejecutar($sql);
		$objDatos->crerrarconexion();
	}
	
	//Modificar datos de usuario
	public function modificar(){
		$objDatos = new clsDatos();
		$sql = "UPDATE usuario SET(id_car='$this->id_car',ced_usu='$this->ced_usu',pno_usu='$this->pno_usu',sno_usu='$this->sno_usu',pap_usu='$this->pap_usu',sap_usu='$this->sap_usu',fna_usu='$this->fna_usu',cel_usu='$this->cel_usu',tel_usu='$this->tel_usu',fot_usu='$this->fot_usu',nus_usu='$this->nus_usu',con_usu='$this->con_usu',ema_usu='$this->ema_usu',ffc_usu='$this->ffc_usu',est_usu='$this->est_usu')";
		$objDatos->ejecutar($sql);
		$objDatos->crerrarconexion();
	}
	
	//Dar de baja a usuario
	public function dar_baja(){
		$objDatos = new clsDatos();
		$sql = "DELETE FROM usuario WHERE (ced_usu='$this->ced_usu')";
		$objDatos->ejecutar($sql);
		$objDatos->crerrarconexion();
	}
}	

?>