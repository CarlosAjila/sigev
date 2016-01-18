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

$array_popup=$objpaciente->listar_paciente_popup();
//variable para control del arreglo
$i=0;

?>
<script type="text/javascript">
<?php do{?>
	
<?php 
$i++;
}while($i<sizeof($array_popup)); ?>
</script>