<?php
require_once("../Modelo/clsPersona.php");
require_once("../Modelo/clsPaciente.php");

/*Sección para editar datos del usuario por parte del administrador*/

//Instancia de clase persona
$objpersona=new clsPersona("","","","","","","","","","","");
//Instancia de clase usuario
$objpaciente = new clsPaciente("", "", "", "", "", "", "", "", "", "", "", "", "");	

$id_car = $_POST['id_car'];
$id_per = $_POST['id_per'];
$fecha = $_POST['fecha'];

$objpaciente->modificar_usuario($id_car,$id_per,$fecha);
include("listar_paciente.php");
/*Fin de la sección para editar datos de usuario*/