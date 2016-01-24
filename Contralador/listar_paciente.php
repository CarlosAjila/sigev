
<?php

require_once("../Modelo/clsPacienteAux.php");

$dato = $_POST['dato'];

//Instancia de clase usuario
$objpaciente = new clsPacienteAux("", "", "", "", "", "", "", "", "", "", "", "", "");
//Arreglo para captar a todas las cuentas de usuario registradas
$arre = $objpaciente->listar_persona_paciente($dato);
//Variable para recorrer el arreglo de cuentas de usuario
$i = 0;
        


echo '<table class="tablaborde" border="1">
        	<tr>
            	<th class="encabezadolista">Cedula</th>
                <th class="encabezadolista">Nombre</th>
                <th class="encabezadolista">Apellido</th>
                <th class="encabezadolista">Sexo</th>
				<th colspan="2" class="encabezadolista">Opciones</th>
            </tr>';
do {
    echo '<tr>
				<td style="padding:3px;">' . $arre[$i]["ced_per"] . '</td>
				<td>' . $arre[$i]["nombre"] . '</td>
				<td>' . $arre[$i]['apellido'] . '</td>
				<td>' . $arre[$i]['sex_per'] . '</td>
                                <td><input type="hidden" name="hd_idper' . $i . '" id="hd_idper' . $i . '" value="' . $arre[$i]["id_per"] . '"/><a href="javascript:eliminarPaciente(' . $arre[$i]['id_per'] . ');">Eliminar</a></td>
                                <td><input type="hidden" name="hd_idper' . $i . '" id="hd_idper' . $i . '" value="' . $arre[$i]["id_per"] . '"/><a href="javascript:c_modificarPaciente(' . $arre[$i]['id_per'].');">Modificar</a></td>
                                <td><input type="hidden" name="Cod_Per" id="Cod_Per" value="'.$arre[$i]["id_per"] . '"/></td>
                                    
		 	</tr>';
    $i++;
    $contador++;
} while ($i < sizeof($arre));
$total = $contador - 1;
?>