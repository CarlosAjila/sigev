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
//Obtencion del arreglo de pacientes
$arreglo_pacientes=$objpaciente->listar_paciente();
//variable para control del arreglo
$i=0;

echo '<table class="tablaflotante">
	  <tr>
		  <td colspan="2">Lista de Casos</td>
	  </tr>
	  <tr><td>Paciente</td><td>Enfermedad</td></tr>';
	do{
		echo '<tr>
					<td>'.$arreglo_pacientes[$i]["paciente"].'</td>
					<td>'.$arreglo_pacientes[$i]["enfermedad"].'</td>
					<td>
						<a href="javascript:buscar('.$arreglo_pacientes[$i]['longitud'].','.$arreglo_pacientes[$i]['latitud'].');">Buscar</a>
						<a href="javascript:trabajo_campo('.$arreglo_pacientes[$i]['longitud'].','.$arreglo_pacientes[$i]['latitud'].','.$arreglo_pacientes[$i]['id_pac'].','.$arreglo_pacientes[$i]['paciente'].');">Buscar</a>
					</td>
			 </tr>';
		$i++;
	}while($i<sizeof($arreglo_pacientes));
echo '</table>';
?>