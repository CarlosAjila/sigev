
<?php
require_once("../Modelo/clsPaciente.php");;

$casoPaciente = $_POST['txtcaspac'];
//Instancia de clase usuario
$objpaciente = new clsPaciente("", "", "", "", "", "", "", "", "", "", "", "", "");
//Arreglo para captar a todas las cuentas de usuario registradas
$arre = $objpaciente->c_lista_casos_paciente($casoPaciente);
//Variable para recorrer el arreglo de cuentas de usuario
$i = 0;
echo '<table class="tablaborde" border="1">
        <tr>
            <th class="encabezadolista">Cédula</th>
            <th class="encabezadolista">Nombre</th>
            <th class="encabezadolista">Apellido</th>
            <th class="encabezadolista">Enfermedad</th>
            <th class="encabezadolista">Prioridad</th>
            <th class="encabezadolista">Fecha de Registro</th>
            <th class="encabezadolista">Caso</th>
        </tr>';
do {
    echo '<tr>
                <td>' . $arre[$i]["cedula"] . '</td>
                <td>' . $arre[$i]["nombre"] . '</td>
                <td>' . $arre[$i]['apellido'] . '</td>
                <td>' . $arre[$i]['enfermedad'] . '</td>
                <td>' . $arre[$i]['prioridad'] . '</td>
                <td>' . $arre[$i]['fechaRegistro'] . '</td>
                <td>' . $arre[$i]['caso'] . '</td>
        </tr>';
    $i++;
    $contador++;
} while ($i < sizeof($arre));
echo '</table>';
$total = $contador - 1;
?>