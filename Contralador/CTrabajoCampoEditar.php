<?php
require_once("../Modelo/clsTrabajo_campo.php");

if(isset($_POST['editar_trabajo_campo']))
{		
	//sleep(3);
	$archivo="";
	//proceso para insertar foto   				
	$file=$_POST['ruta_imagen'];	//ruta de la imagen		   		
	
			
	$id = $_POST['id_trabajo'];
	$n_personas=$_POST['num_personas'];
	$t_criadero=$_POST['tipo_criadero'];
	$sector=$_POST['sector'];
	$obs=$_POST['observacion'];
	$t_maquina=$_POST['tipo_maquina'];
	$t_quimico=$_POST['tipo_quimico'];
	$c_quimico=$_POST['cant_quimico'];
	$criterio=$_POST['criterio_tecnico'];
		
	
	//Modifica en la tabla Trabajo campo
	$objtrabajo_campo=new clsTrabajo_campo($n_personas,$t_criadero,$sector,$obs,$t_maquina,$t_quimico,$c_quimico,$criterio,"A",$file);
	$objtrabajo_campo->modificar($id);								
	
	$mensaje="Datos Modificados con Éxito-->";
	$salidaJson = array("mensaje" => $mensaje);
	echo json_encode($salidaJson);
	
}
?>