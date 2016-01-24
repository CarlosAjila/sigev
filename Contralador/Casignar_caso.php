<?php
require_once("../Modelo/clsUsuario.php");

/*Sección para asignar casos al vigilante*/

//Instancia de clase usuario
$objusuario=new clsUsuario("","","","","","","","");	

$id_pac = $_POST['id_pac'];
$id_usu = $_POST['id_usu'];
$tip_aca = $_POST['tip_aca'];

$objusuario->asignar_caso($id_pac,$id_usu,$tip_aca);
include("Clista_visitador.php");
/*Fin de la sección para editar datos de usuario*/