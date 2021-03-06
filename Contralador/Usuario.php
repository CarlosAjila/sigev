<?php
require_once("../Modelo/clsPersona.php");
require_once("../Modelo/clsUsuario.php");

$a=3;
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
	$id_per=$objpersona->insertar($id_loc,$ced_per,$pno_per,$sno_per,$apa_per,$ama_per,$fna_per,$te1_per,$te2_per,$sex_per);
	
	$objusuario=new clsUsuario($id_per,$id_car,$fot_usu,$nus_usu,$con_usu,$ema_usu,$ffc_usu,$estado);
	$objusuario->insertar($id_per,$id_car,$fot_usu,$nus_usu,$con_usu,$ema_usu,$ffc_usu,$estado);
	
	$mensaje="Cuenta de usuario registrada con éxito";
	$salidaJson = array("mensaje" => $mensaje);
	echo json_encode($salidaJson);
}

if(isset($_POST['editar_perfil']))
{
	
	/*Datos de persona*/
	$id_per=$_POST['id_per'];
	$ced_per=$_POST['txtcedula'];
	$fna_per=$_POST['txtfna'];
	$pno_per=$_POST['txtpnombre'];
	$sno_per=$_POST['txtsnombre'];
	$apa_per=$_POST['txtapaterno'];
	$ama_per=$_POST['txtamaterno'];
	$te1_per=$_POST['txtte1'];
	$te2_per=$_POST['txtte2'];
	$id_loc=$_POST['id_loc'];
	/*Datos de usuario*/
	$fot_usu=$_POST['ruta_imagen'];
	$id_usu=$_POST['id_usu'];
	$ema_usu=$_POST['txtemail'];
	$nus_usu=$_POST['txtusuario'];
	$con_usu=$_POST['txtpass'];
	
	$objpersona=new clsPersona("","","","","","","","","","","");
	$objpersona->editar_perfil_persona($id_per,$ced_per,$pno_per,$sno_per,$apa_per,$ama_per,$te1_per,$te2_per,$fna_per,$id_loc);
	//$objpersona->editar_perfil_persona('7','0705212968','CCarlos','Alberto','Ajila','Moreira','2944787','0990325687','2012-01-16');
	
	$objusuario=new clsUsuario("","","","","","","","");
	$objusuario->editar_perfil_usuario($id_usu,$ema_usu,$nus_usu,$con_usu,$fot_usu);
	//$objusuario->editar_perfil_usuario('7','karlos@gmail.com','Carlos','123456');
	
	$mensaje="Cuenta de usuario editada con éxito. Para que se adjudiquen los cambios debe cerrar sesión";
	$salidaJson = array("mensaje" => $mensaje);
	echo json_encode($salidaJson);
}
?>