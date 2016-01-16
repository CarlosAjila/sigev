<script language="javascript">
$(document).ready(function()
{
	//$('#cargo0').val(3);
	$("[id^='cod']").on('click',function(){
    counter=$("#contador").val();
		for(i=0; i<=counter; i++){
			var id=$('#txtidper'+i).val();
			var se=$('#cargo'+i).val();
			ver(id,se);
		}
	});
})

</script>
<?php
require_once("../Modelo/clsPersona.php");
require_once("../Modelo/clsUsuario.php");

//Instancia de clase persona
$objpersona=new clsPersona("","","","","","","","","","","");
//Instancia de clase usuario
$objusuario=new clsUsuario("","","","","","","","");	

//Arreglo para captar a todas las cuentas de usuario registradas
$arre=$objpersona->listar_persona($_POST['dato']);
//Arreglo para captar todos los cargos disponibles
$arreglo_cargo=$objusuario->listar_cargo();

//Variable para recorrer el arreglo de cuentas de usuario
$i=0;

//Variable para recorre el arreglo de cargos
$c=0;
	
echo '<table>
        	<tr>
            	<th>Cédula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Sexo</th>
				<th>Lugar de vivienda</th>
				<th>Cargo</th>
				<th>Fecha fin de contrato</th>
				<th>Opciones</th>
            </tr>';
do{
	echo '<tr>
				<td>'.$arre[$i]["ced_per"].'</td>
				<td>'.$arre[$i]["nombre"].'</td>
				<td>'.$arre[$i]['apellido'].'</td>
				<td>'.$arre[$i]['sex_per'].'</td>
				<td>'.$arre[$i]['nom_loc'].'</td>
				<td>
				<select id="cargo'.$i.'" name="cargo'.$i.'">';
					do{
					echo '<option value="'.$arreglo_cargo[$c]['id_car'].'">'.$arreglo_cargo[$c]['nom_car'].'</option>';
						$c++;
					}while($c<sizeof($arreglo_cargo));
					echo '</select></td>
				<td>'.$arre[$i]['ffc_usu'].'</td>
				<td><input type="button" name="cod" id="cod" value="Editar"/><a href="javascript:eliminar('.$arre[$i]["id_per"].');">Eliminar</a></td>
				<td><input type="hidden" name="txtidper'.$i.'" id="txtidper'.$i.'" value="'.$arre[$i]["id_per"].'"/></td>
				';
$i++;
$c=0;
}while($i<sizeof($arre));
$i=$i-1;
echo '<td><input type="hidden" name="contador" id="contador" value="'.$i.'"/></td></tr></table>';

/*Sección para cargar la opción ya elegida en el combobox*/
	$i=0;
do{
	echo '<script language="javascript">$(document).ready(function(){'; 
	echo '$("#cargo'.$i.'").val("'.$arre[$i]["id_car"].'")';
	echo '})</script>';
	$i++;
}while($i<sizeof($arre));
?>
