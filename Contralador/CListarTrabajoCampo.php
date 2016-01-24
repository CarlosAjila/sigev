<?php
require_once("../Modelo/clsTrabajo_campo.php");

$objlistar = new clsTrabajo_campo("","","","","","","","","","");

$arreglo_listar = $objlistar->listar($_POST['dato']);

$i = 0; //contador para el recorrido de los registros		 						 
echo '<table class="tablaborde" border="1">
	<tr>
    	<th class="encabezadolista">Cedula</th>
        <th class="encabezadolista">Nombre</th>
                <th class="encabezadolista">Fecha Registro</th>
                <th class="encabezadolista">Caso</th>
                <th class="encabezadolista">Enfermedad</th>
				<th class="encabezadolista"># Personas Infectadas</th>
                <th class="encabezadolista">Tipo Criadero</th>
				<th class="encabezadolista">Sector Endémico</th>
				<th class="encabezadolista">Tipo de Máquina</th>
				<th class="encabezadolista">Acción</th>
            </tr>';
do{
	
	
	echo '<tr>
		<td style="padding:3px;">'.$arreglo_listar[$i]["Cedula"].'</td>
		<td>'.$arreglo_listar[$i]["Nombre"].'</td>
		<td>'.$arreglo_listar[$i]['Fecha'].'</td>
		<td>'.$arreglo_listar[$i]['Caso'].'</td>
		<td>'.$arreglo_listar[$i]['Enfermedad'].'</td>
		<td>'.$arreglo_listar[$i]['n_personas'].'</td>
		<td>'.$arreglo_listar[$i]['tipo_criadero'].'</td>	
		<td>'.$arreglo_listar[$i]['sector_endemico'].'</td>	
		<td>'.$arreglo_listar[$i]['tipo_maquina'].'</td>					
		
		<td> <input type="hidden" id="$arreglo_listar[$i]["id_trabajo_campo"]" name="$arreglo_listar[$i]["id_trabajo_campo"]" value="$arreglo_listar[$i]["id_trabajo_campo"]" />
			<a href="javascript:AbrirDialogo(' . $arreglo_listar[$i]['id_trabajo_campo'].');" >Ver Ficha</a>
		
		
		</td>
	</tr>';
	$i++;
}while($i<sizeof($arreglo_listar));
	echo '</table>';
?>