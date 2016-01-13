<?php
/*
Tipo de archivo: Clase
Descripción: Clase localizacion
Desarrollado por: José Ambuludí
Fecha de elaboración: 10 de Enero de 2016
Fecha de modificación: 10 de Enero de 2016
Versión: 0.1
*/
require_once("clsDatos.php");
class clslocalizacion{

	//Declarando datos
	public $nom_loc;
	public $arreglo = array();
	
	//Constructor
	public function __construct($nom_loc){
		$this->nom_loc = $nom_loc;
	}
	
	//Destructor
	public function __destruct(){
	}
	
	//Getters
	public function get_nom_loc(){
		return $this->nom_loc;
	}
	
	//Función para buscar usuarios
	public function buscar(){
		$objDatos = new clsDatos();
		$sql="SELECT localizacion.nom_loc AS parroquia, localizacion.id_loc, localizacion.cpa_loc AS cod_parroquia, 
(SELECT localizacion.nom_loc FROM localizacion WHERE localizacion.id_loc=cod_parroquia) AS canton,
(SELECT localizacion.cpa_loc FROM localizacion WHERE localizacion.id_loc=cod_parroquia) AS cod_canton,
(SELECT localizacion.nom_loc FROM localizacion WHERE localizacion.id_loc=cod_canton) AS provincia,
(SELECT localizacion.cpa_loc FROM localizacion WHERE localizacion.id_loc=cod_canton) AS cod_provincia,
(SELECT localizacion.nom_loc FROM localizacion WHERE localizacion.id_loc=cod_provincia) AS pais
FROM localizacion
WHERE nom_loc LIKE '%$this->nom_loc%' AND tip_loc='parroquia'";
		$datos_desordenados = $objDatos->consulta($sql);
		while($columna = $objDatos->arreglos($datos_desordenados))
		{
			$this->arreglo [] = array("value"=>'Parroquia:'.$columna['parroquia'].' Canton:'.$columna['canton'],
									  "id_loc"=>$columna['id_loc']);
		}
		return($this->arreglo);
	}
}
?>