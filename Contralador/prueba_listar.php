
<script language="javascript">
$(document).ready(function()
{
	$('#bteditar').click(function(){
	counter=$("#cont_elementos").val();
	var pregunta = confirm('¿Esta seguro de editar estos USUARIOS?');
	if(pregunta==true){
		for(indice=0; indice<=counter; indice++){
			var fecha=$('#txtfecha'+indice).val();
			var id_per=$('#hd_idper'+indice).val();
			var id_car=$('#cargo'+indice).val();
			editar(id_per,id_car,fecha);
		}
	}else{
		return false;
	}
	});
})
</script>

<script language="javascript">
//Para el manejo de fechas
var opciones_datepicker={ changeYear: true,
			dateFormat: "yy-mm-dd",
			monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
			dayNames: [ "Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado" ],
			dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
			yearRange:"1950:2050"
};
$(document).ready(function(e) {
	$("[id^='txtfecha']").datepicker(opciones_datepicker);
});
</script>
<?php
require_once("../Modelo/clsPersona.php");
require_once("../Modelo/clsUsuario.php");

$dato = $_POST['dato'];

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
//Variable contador para el número total de elementos
$contador=0;
$total=0;

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

/*Sección para cargar la opción ya elegida en el combobox*/
//Arreglo para captar a todas las cuentas de usuario registradas
$arre_rol=$objpersona->listar_persona($_POST['dato']);

$j=0;
do{
	echo '<script language="javascript">$(document).ready(function(){'; 
	echo '$("#cargo'.$j.'").val("'.$arre_rol[$j]["id_car"].'")';
	echo '})</script>';
	$j++;
}while($j<sizeof($arre_rol));

echo '<table class="tablaborde" border="1">
        	<tr>
            	<th class="encabezadolista">Cedula</th>
                <th class="encabezadolista">Nombre</th>
                <th class="encabezadolista">Apellido</th>
                <th class="encabezadolista">Sexo</th>
                <th class="encabezadolista">Lugar de vivienda</th>
				<th class="encabezadolista">Cargo</th>
                <th class="encabezadolista">Fecha de fin de contrato</th>
				<th class="encabezadolista">Eliminar</th>
            </tr>';
do{
	echo '<tr>
				<td style="padding:3px;">'.$arre[$i]["ced_per"].'</td>
				<td>'.$arre[$i]["nombre"].'</td>
				<td>'.$arre[$i]['apellido'].'</td>
				<td>'.$arre[$i]['sex_per'].'</td>
				<td>'.$arre[$i]['nom_loc'].'</td>
				<td>
					<select id="cargo'.$i.'" name="cargo'.$i.'" class="cargo">';
					do{
					echo '<option value="'.$arreglo_cargo[$c]['id_car'].'">'.$arreglo_cargo[$c]['nom_car'].'</option>';
						$c++;
					}while($c<sizeof($arreglo_cargo));
				echo '</select></td>
				<td><input type="text" name="txtfecha'.$i.'" id="txtfecha'.$i.'" value="'.$arre[$i]["ffc_usu"].'" readonlu="readonly" /></td>
				<td><input type="hidden" name="hd_idper'.$i.'" id="hd_idper'.$i.'" value="'.$arre[$i]["id_per"].'"/><a href="javascript:eliminarProducto('.$arre[$i]['id_per'].');">Eliminar</a></td>
		 	</tr>';
$i++;
$contador++;
$c=0;
}while($i<sizeof($arre));
$total=$contador-1;
echo '</table><input type="hidden" name="cont_elementos" id="cont_elementos" value="'.$total.'"/>
<table width="100%"><tr><td><input type="button" name="bteditar" id="bteditar" class="imageneditarboton" /></td></tr>
<tr><td>Editar</td></tr></table>';
?>