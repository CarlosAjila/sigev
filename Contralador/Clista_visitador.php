<!--
Tipo de archivo: php
Descripción: Archivo para asignar casos a los visitadores
Desarrollado por: José Ambuludí
Fecha de elaboración: 20 de Enero de 2016
Fecha de modificación: 23 de Enero de 2016
Ruta: /Controlador/Clista_visitador.php
Versión: 0.2
-->
<script language="javascript">
$(document).ready(function()
{
	$('#bteditar').click(function(){
	counter=$("#cont_elementos").val();
	var pregunta = confirm('¿Esta seguro de realizar esta asignación?');
	if(pregunta==true){
		for(indice=0; indice<=counter; indice++){
			//var fecha=$('#txtfecha'+indice).val();
			var id_usu=$('#hd_idusu'+indice).val();
			var id_pac=$('#caso'+indice).val();
			var tip_aca="V";
			//alert(id_usu+id_pac+tip_aca);
			asignar(id_pac,id_usu,tip_aca);
		}
	}else{
		return false;
	}
	});
})
</script>

<?php
require_once("../Modelo/clsPersona.php");
require_once("../Modelo/clsUsuario.php");
require_once("../Modelo/clsPaciente.php");

$dato = $_POST['dato'];

//Instancia de clase persona
$objpersona=new clsPersona("","","","","","","","","","","");
//Instancia de clase usuario
$objusuario=new clsUsuario("","","","","","","","");	
//Instancia de clase paciente
$objpaciente=new clsPaciente("","","","","","","","","","","","","");

//Arreglo para captar a todas las cuentas de usuario registradas
$arre=$objpersona->listar_visitadores($_POST['dato']);

//Arreglo para captar todos los cargos disponibles
$arreglo_cargo=$objusuario->listar_cargo();

//Arreglo para captar el listado de pacientes
$arreglo_pacientes=$objpaciente->listar_paciente_asignar_vigilante();

//Variable para recorrer el arreglo de cuentas de usuario
$i=0;
//Variable para recorre el arreglo de cargos
$c=0;
//Variable contador para el número total de elementos
$contador=0;
$total=0;

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="tablaborde" border="1">
        	<tr>
            	<th class="encabezadolista">Cedula</th>
                <th class="encabezadolista">Nombre</th>
                <th class="encabezadolista">Apellido</th>
                <th class="encabezadolista">Lugar de vivienda</th>
				<th class="encabezadolista">Casos-Paciente</th>
				<th class="encabezadolista">Casos asignados</th>
            </tr>';
do{
	echo '<tr>
				<td style="padding:3px;">'.$arre[$i]["ced_per"].'</td>
				<td>'.$arre[$i]["nombre"].'</td>
				<td>'.$arre[$i]['apellido'].'</td>
				<td>'.$arre[$i]['nom_loc'].'</td>
				<td>
					<select id="caso'.$i.'" name="caso'.$i.'">';
					do{
					echo '<option value="'.$arreglo_pacientes[$c]['id_pac'].'">'.$arreglo_pacientes[$c]['paciente'].' - '.$arreglo_pacientes[$c]['enfermedad'].'</option>';
						$c++;
					}while($c<sizeof($arreglo_pacientes));
				echo '</select></td>
				<td><input type="hidden" name="hd_idusu'.$i.'" id="hd_idusu'.$i.'" value="'.$arre[$i]["id_usu"].'"/><a href="javascript:ver_casos_asignados('.$arre[$i]["id_usu"].');">Ver</a></td>
		 	</tr>';
$i++;
$contador++;
$c=0;
}while($i<sizeof($arre));
$total=$contador-1;
echo '</table><input type="hidden" name="cont_elementos" id="cont_elementos" value="'.$total.'"/>
<table width="100%"><tr><td><input type="button" name="bteditar" id="bteditar" class="imagenasignar" /></td></tr>
<tr><td>Asignar</td></tr></table>';
?>