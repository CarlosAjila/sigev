<?php
require_once("../Modelo/clsPersona.php");
require_once("../Modelo/clsUsuario.php");

if(isset($_POST['save_usuario']))
{
	/*Datos de persona*/
	$id_loc=$_POST['id_loc'];
	$ced_per=$_POST['txtcedula'];
	$fna_per=$_POST['txtfn'];
	$pno_per=$_POST['txtpnombre'];
	$sno_per=$_POST['txtsnombre'];
	$apa_per=$_POST['txtapaterno'];
	$ama_per=$_POST['txtamaterno'];
	$te1_per=$_POST['txtcel'];
	$te2_per=$_POST['txttel'];
	$sex_per=$_POST['sex_per'];
	/*Datos de usuario*/
	$fot_usu=$_POST['ruta_imagen'];
	$ema_usu=$_POST['txtemail'];
	$nus_usu=$_POST['txtnusuario'];
	$con_usu=$_POST['txtpass'];
	$id_car="1";
	$ffc_usu="2080-12-31";
	$estado="I";
	
	
	$objpersona=new clsPersona($id_loc,$ced_per,$pno_per,$sno_per,$apa_per,$ama_per,$fna_per,$te1_per,$te2_per,$sex_per,$estado);
	$id_per=$objpersona->insertar();
	
	$objusuario=new clsUsuario($id_per,$id_car,$fot_usu,$nus_usu,$con_usu,$ema_usu,$ffc_usu,$estado);
	$objusuario->insertar();
	
	$mensaje="Cuenta de usuario registrada con éxito";
	$salidaJson = array("mensaje" => $mensaje);
	echo json_encode($salidaJson);
}

/*Sección para listar usuarios registrados*/
/*Datos de persona*/
$id_loc="";
$ced_per="";
$fna_per="";
$pno_per="J";
$sno_per="";
$apa_per="";
$ama_per="";
$te1_per="";
$te2_per="";
$sex_per="";

$objpersona=new clsPersona($id_loc,$ced_per,$pno_per,$sno_per,$apa_per,$ama_per,$fna_per,$te1_per,$te2_per,$sex_per,$estado);
$arreglo=$objpersona->listar_persona();

echo json_encode($arreglo);
?>