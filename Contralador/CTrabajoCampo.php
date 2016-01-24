<?php
require_once("../Modelo/clsTrabajo_campo.php");
require_once("../Modelo/clsFichaPaciente.php");

if(isset($_POST['save_trabajo_campo']))
{							
		$file=$_POST['ruta_imagen'];	//carga la ruta de la imagen		   			
		
		/*Datos del Trabajo Campo*/
		$id_paciente=$_POST['id_pac'];  // clave primaria del paciente
		$n_personas=$_POST['num_personas'];
		$t_criadero=$_POST['tipo_criadero'];
		$sector=$_POST['sector'];
		$obs=$_POST['observacion'];
		$t_maquina=$_POST['tipo_maquina'];
		$t_quimico=$_POST['tipo_quimico'];
		$c_quimico=$_POST['cant_quimico'];
		$criterio=$_POST['criterio_tecnico'];
		
		//Inserta en la tabla Trabajo campo
		$objtrabajo_campo=new clsTrabajo_campo($n_personas,$t_criadero,$sector,$obs,$t_maquina,$t_quimico,$c_quimico,$criterio,"A",$file);
		$id_trabajo_campo = $objtrabajo_campo->insertar();
		
		//Inserta en la taba ficha paciente
		$objficha_paciente = new clsFichaPaciente($id_paciente,$id_trabajo_campo,"A");
		$objficha_paciente->insertar();
		
		
		$mensaje="Datos Registrados con Éxito-->";
		$salidaJson = array("mensaje" => $mensaje);
		echo json_encode($salidaJson);		
	
}
?>