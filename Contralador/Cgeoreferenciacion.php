<?php
require_once("../Modelo/clsGeoreferenciacion.php");

if(isset($_POST['save_paciente']))
{
	$lat_geo=$_POST['latitud'];
	$lon_geo=$_POST['longitud'];
	
	$objgeoreferenciacion=new clsGeoreferenciacion($lat_geo,$lon_geo);
	$objgeoreferenciacion->insertar($lat_geo,$lon_geo);
	
	$mensaje="Registro éxitoso";
	$salidaJson = array("mensaje" => $mensaje);
	echo json_encode($salidaJson);
}
?>