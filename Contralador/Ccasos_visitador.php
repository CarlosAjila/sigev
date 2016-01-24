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

$id_usu=$_POST['id_usu'];
$objpaciente=new clsPaciente("","","","","","","","","","","","","");
//Obtencion del arreglo de pacientes
$arreglo_pacientes=$objpaciente->lista_casoos_x_visitador($id_usu);
//variable para control del arreglo
//<a href='javascript:trabajo_campo(".$arreglo_pacientes[$i]['longitud'].",".$arreglo_pacientes[$i]['latitud'].",".$arreglo_pacientes[$i]['id_pac'].",\".$arreglo_pacientes[$i]['id_pac'].\");'>Trabajo</a>
$i=0;

echo "<table width='100%' border='1' style='border:1px solid #000; border-collapse:collapse;'>
		<tr>
			<td colspan='3' width='100%' style='background-color:#036; color:#FFF; font-weight:bold; align=center'>Listado de pacientes asignados a visitador</td>
		</tr>
		<tr>
			<td width='30%' style='background-color:#036; color:#FFF; font-weight:bold; align=center'>Paciente</td>
			<td width='15%' style='background-color:#036; color:#FFF; font-weight:bold; align=center'>Enfermedad</td>
			<td width='30%' style='background-color:#036; color:#FFF; font-weight:bold; align=center'>Localidad</td>
		</tr>";
		if(sizeof($arreglo_pacientes)==0)
		{
			echo "<tr><td>No se han asignado casos</td></tr>";
		}
		else
		{
	  do{
		echo "<tr>
					<td>".$arreglo_pacientes[$i]["paciente"]."</td>
					<td>".$arreglo_pacientes[$i]["enfermedad"]."</td>
					<td>".$arreglo_pacientes[$i]["sector"]."</td>
			 </tr>";
		$i++;
	}while($i<sizeof($arreglo_pacientes));
		}
echo "</table>";
?>