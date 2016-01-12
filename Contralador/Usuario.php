<?php
require_once("../Modelo/clsUsuario.php");

if(isset($_POST['save_usuario']))
{
	$ruta_imagen=$_POST['ruta_imagen'];
	$cedula=$_POST['txtcedula'];
	$fecha_nacimiento=$_POST['txtfn'];
	$pnombre=$_POST['txtpnombre'];
	$snombre=$_POST['txtsnombre'];
	$apaterno=$_POST['txtapaterno'];
	$amaterno=$_POST['txtamaterno'];
	$cel=$_POST['txtcel'];
	$tel=$_POST['txttel'];
	$email=$_POST['txtemail'];
	$nusuario=$_POST['txtnusuario'];
	$pass=$_POST['txtpass'];
	$cargo=$_POST['txtcargo'];
	$ffc=$_POST['txtffc'];
	$estado="I";
	
	//echo "cedula".$cedula;
	
	$objusuario=new clsPersona($cargo,$cedula,$pnombre,$snombre,$apaterno,$amaterno,$fecha_nacimiento,$cel,$tel,$ruta_imagen,$nusuario,$pass,$email,$ffc,$estado);
	//$objusuario = new clsPersona("2","0705212744","jose","lanier","ambulu","mar","2016-01-26","070","12","imagen","jose","123","gmail","2016-01-24","I");
	$objusuario->insertar();
	$salidaJson = array("cargo" => $cargo,
						"cedula" => $cedula,
						"pnombre" => $pnombre,
						"snombre" => $snombre,
						"apaterno" => $apaterno,
						"amaterno" => $amaterno,
						"fecha_nacimiento" => $fecha_nacimiento,
						"cel" => $cel,
						"tel" => $tel,
						"ruta_imagen" => $ruta_imagen,
						"nusuario" => $nusuario,
						"pass" => $pass,
						"email" => $email,
						"ffc" => $ffc,
						"estado" => $estado);
	echo json_encode($salidaJson);
	
}
?>