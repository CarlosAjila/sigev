<?php
require_once("../Modelo/clsUsuario.php");

//Instancia de clase usuario
$objusuario=new clsUsuario("","","","","","","","");
	
if(isset($_POST['txtusuario']) && isset($_POST['txtpassword']))
{
	$arreglo=$objusuario->M_validar_usuario($_POST['txtusuario'],$_POST['txtpassword']);
	if($arreglo[0]['pno_per']!="")
	{
		session_start();
		$_SESSION['ced_per']=$arreglo[0]['ced_per'];
		$_SESSION['pno_per']=$arreglo[0]['pno_per'];
		$_SESSION['sno_per']=$arreglo[0]['sno_per'];
		$_SESSION['apa_per']=$arreglo[0]['apa_per'];
		$_SESSION['ama_per']=$arreglo[0]['ama_per'];
		$_SESSION['te1_per']=$arreglo[0]['te1_per'];
		$_SESSION['te2_per']=$arreglo[0]['te2_per'];
		$_SESSION['fna_per']=$arreglo[0]['fna_per'];
		$_SESSION['nus_usu']=$arreglo[0]['nus_usu'];
		$_SESSION['con_usu']=$arreglo[0]['con_usu'];
		$_SESSION['fot_usu']=$arreglo[0]['fot_usu'];
		$_SESSION['ema_usu']=$arreglo[0]['ema_usu'];
		$_SESSION['nom_car']=$arreglo[0]['nom_car'];
		$_SESSION['nom_loc']=$arreglo[0]['nom_loc'];
		$_SESSION['id_loc']=$arreglo[0]['id_loc'];
		$_SESSION['id_usu']=$arreglo[0]['id_usu'];
		$_SESSION['id_per']=$arreglo[0]['id_per'];
		
		if($arreglo[0]['pno_per']!="" && $arreglo[0]['id_car']==4)
		{
			
			?>
			<script type="text/javascript">
				window.location="../Vista/Administrador/Inicio.php";
			</script>
		<?php 
		}
		else if($arreglo[0]['pno_per']!="" && $arreglo[0]['id_car']==5)
		{
			?>
			<script type="text/javascript">
				window.location="../Vista/Estadistica/Inicio.php";
			</script>
		<?php
		}
	}
	else
	{?>
    	<script type="text/javascript">
			window.location="../Inicio.php";
        </script>
	<?php }
}
?>