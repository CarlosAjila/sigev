<?php
/*
Tipo de archivo: clase
Descripción: Clase AC_cronograma
Desarrollado por: Carlos Ajia
Fecha de elaboración: 13 de Enero de 2016
Fecha de modificación: 13 de Enero de 2016
Versión: 0.1
*/
require_once("clsDatos.php");
class clsAc_cronograma{

//Declarando datos
    public $id_acc;
    public $id_aca;
    public $id_cro;
    public $est_acc;


	//Constructor
	public function __construct($id_acc,$id_aca,$id_cro,$est_acc){
		$this->id_acc = $id_acc;
		$this->id_aca = $id_aca;
		$this->id_cro = $id_cro;
		$this->est_acc = $est_acc;
	}
	
	//Destructor
	public function __destruct(){
	}
        
	//Getters
	function get_id_acc() {
            return $this->id_acc;
        }

        function get_id_aca() {
            return $this->id_aca;
        }

        function get_id_cro() {
            return $this->id_cro;
        }

        function get_est_acc() {
            return $this->est_acc;
        }	
	//Función para buscar un usuario
	public function buscar(){
		$encontro = false;
		$objDatos = new clsDatos();
		$sql = "SELECT * FROM ac_cronograma WHERE id_acc='$this->id_acc'";
		$datos_desordenados = $objDatos->consulta($sql);
		
		if($columna = $objDatos->arreglos($datos_desordenados))
		{
			$this->id_acc = $columna['id_acc'];
			$this->id_aca = $columna['id_aca'];
			$this->id_cro = $columna['id_cro'];
			$this->est_acc = $columna['est_acc'];
			$encontro = true;
		}
		//Cerrar la consulta
		$objDatos->cerrar_consulta($datos_desordenados);
		$objDatos->crerrarconexion();
		return $encontro;
	}
	
	//Insertar ac_cronograma
	public function insertar(){
		$objDatos = new clsDatos();
		$sql = "INSERT INTO ac_cronograma (id_acc, id_aca, id_cro, est_acc)
                         VALUES ('$this->id_acc', '$this->id_aca', '$this->id_cro', '$this->est_acc');";
		$objDatos->ejecutar($sql);
		$objDatos->crerrarconexion();
	}
	
	//Modificar datos de persona
	public function modificar(){
		$objDatos = new clsDatos();
		$sql = "UPDATE ac_cronograma SET id_acc = '$this->id_acc', id_aca = '$this->id_aca',
                          id_cro = '$this->id_cro',est_acc = '$this->est_acc';";
		$objDatos->ejecutar($sql);
		$objDatos->crerrarconexion();
	}
	
	//Dar de baja a una persona
	public function dar_baja(){
		$objDatos = new clsDatos();
		$sql = "UPDATE usuario SET(est_acc='I')";
		$objDatos->ejecutar($sql);
		$objDatos->crerrarconexion();
	}
}	
?>