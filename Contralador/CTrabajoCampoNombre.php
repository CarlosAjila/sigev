<?php
require_once("../Modelo/clsTrabajo_campo.php");
	
	$objlistar = new clsTrabajo_campo("","","","","","","","","","");
	//Permite obtener el nombre del paciente
	$codigo = $_POST['id']; //Obtiene el codigo del paciente
	
	//Realiza la busqueda y retorna el nombre del paciente
	$arreglo_listar = $objlistar->GetNameId($codigo);
	
	echo $arreglo_listar[0]['NombrePaciente'];
?>