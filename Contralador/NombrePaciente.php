<?php
	require_once("../Modelo/clsPaciente.php");
	$objpaciente = new clsPaciente("", "", "", "", "", "", "", "", "", "", "", "", "");

	$resultado = $objpaciente->buscar_paciente_x_codigo(1);


	echo $resultado[0]["nombre"] ;
	echo $resultado[0]["apellido"] ;
?>