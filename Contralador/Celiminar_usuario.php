<?php
require_once("../Modelo/clsPersona.php");
require_once("../Modelo/clsUsuario.php");

//Instancia de clase persona
$objpersona=new clsPersona("","","","","","","","","","","");
//Instancia de clase usuario
$objusuario=new clsUsuario("","","","","","","","");	

/*Sección para dar de baja a un usuario*/
$id = $_POST['id'];
$id_per=$id;
$objpersona->dar_baja($id_per);
$objusuario->dar_baja($id_per);
include("prueba_listar.php");
?>