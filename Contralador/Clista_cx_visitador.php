<?php
/*
Tipo de archivo: controlador
Descripción: Controlador listar paciente
Desarrollado por: José Ambuludí
Fecha de elaboración: 18 de Enero de 2016
Fecha de modificación: 18 de Enero de 2016
Versión: 0.1
*/
require_once("../Modelo/clsPaciente.php");
$objpaciente=new clsPaciente("","","","","","","","","","","","","");
$id_usu=$_POST['id_usu'];
//Obtencion del arreglo de pacientes
$arreglo_pacientes=$objpaciente->lista_casoos_x_visitador($id_usu);
//variable para control del arreglo
//<a href='javascript:trabajo_campo(".$arreglo_pacientes[$i]['longitud'].",".$arreglo_pacientes[$i]['latitud'].",".$arreglo_pacientes[$i]['id_pac'].",\".$arreglo_pacientes[$i]['id_pac'].\");'>Trabajo</a>
$i=0;

echo "<div style='overflow:auto; height:150px; width:100%;'>
		<table class='tablaflotante'>
	  <tr>
		  <td colspan='3' align='center' style='background-color:#036; color:#FFF; font-weight:bold;'>Lista de Casos</td>
	  </tr>
	  <tr style='background-color:#95C6F7; font-weight:bold;' align='center'><td>Paciente</td><td>Enfermedad</td><td>Opción</td></tr>";
	do{
		echo "<tr>
					<td>".$arreglo_pacientes[$i]["paciente"]."</td>
					<td>".$arreglo_pacientes[$i]["enfermedad"]."</td>
					<td>
						
						<a href='javascript:trabajo_campo(".$arreglo_pacientes[$i]['longitud'].",".$arreglo_pacientes[$i]['latitud'].",".$arreglo_pacientes[$i]['id_pac'].");'>Trabajo</a>
						
						<a href='javascript:buscar(".$arreglo_pacientes[$i]['longitud'].",".$arreglo_pacientes[$i]['latitud'].");'>Destino</a>
					</td>
			 </tr>";
		$i++;
	}while($i<sizeof($arreglo_pacientes));
echo "</table></div>";
?>