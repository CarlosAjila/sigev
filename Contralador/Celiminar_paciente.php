<?php
require_once("../Modelo/clsPersona.php");
require_once("../Modelo/clsPacienteAux.php");

//Instancia de clase persona
$objpersona=new clsPersona("","","","","","","","","","","");
//Instancia de clase usuario
$objpaciente = new clsPacienteAux("", "", "", "", "", "", "", "", "", "", "", "", "");

/*Sección para dar de baja a un usuario*/
$id = $_POST['id'];
$id_per=$id;
$objpersona->dar_baja($id_per);
$objpaciente->dar_baja($id_per);
include("listar_paciente.php");
?>