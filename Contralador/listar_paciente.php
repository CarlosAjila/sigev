
<?php

require_once("../Modelo/clsPaciente.php");


echo '1111111111';
$dato = 'a';

//Instancia de clase usuario
$objpaciente = new clsPaciente("", "", "", "", "", "", "", "", "", "", "", "", "");
//Arreglo para captar a todas las cuentas de usuario registradas
$arre = $objpaciente->listar_persona_paciente($dato);
//Variable para recorrer el arreglo de cuentas de usuario
$i = 0;

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Sexo</th>
                <th>Lugar de vivienda</th>
            </tr>';
do {
    echo '<tr>
				<td>' . $arre[$i]["ced_per"] . '</td>
				<td>' . $arre[$i]["nombre"] . '</td>
				<td>' . $arre[$i]['apellido'] . '</td>
				<td>' . $arre[$i]['sex_per'] . '</td>
				<td>' . $arre[$i]['id_per'] . '</td>
                                <td><input type="hidden" name="hd_idper' . $i . '" id="hd_idper' . $i . '" value="' . $arre[$i]["id_per"] . '"/><a href="javascript:eliminarProducto(' . $arre[$i]['id_per'] . ');">Eliminar</a></td>
		 	</tr>';

    $i++;
    $contador++;
} while ($i < sizeof($arre));
$total = $contador - 1;
echo '<tr><td><input type="hidden" name="cont_elementos" id="cont_elementos" value="' . $total . '"/><input type="button" name="bteditar" id="bteditar" value="Editar" /></td></tr></table>';
?>