<?php

require_once("../dompdf/dompdf_config.inc.php");
function conectar_servidor() {
    $hostname_conexion = "localhost";
    $username_conexion = "root";
    $password_conexion = "";
    $conexion = mysqli_connect($hostname_conexion, $username_conexion, $password_conexion, "bd_sigev") or trigger_error(mysql_error(), E_USER_ERROR);
    return $conexion;
}

function ejecutar_sentencia($query) {

    $conectar = conectar_servidor();
    $rs_resultado = mysqli_query($conectar, $query);
    mysqli_close($conectar);
    return $rs_resultado;
}
$fechaDesde = $_POST['txtfechaDesde'];
$fechaHasta = $_POST['txtfechaHasta'];
echo $fechaDesde;

$rs_localidades = ejecutar_sentencia("SELECT per.ced_per, per.pno_per, per.sno_per, per.apa_per, per.ama_per,
                 enf.nom_enf, enf.pri_enf, pac.fre_pac
                FROM persona per 
                INNER JOIN paciente pac ON per.id_per = pac.id_per 
                INNER JOIN paciente_enfermedad pae ON pae.id_pac = pac.id_pac
                INNER JOIN enfemedad enf ON enf.id_enf = pae.id_enf 
                WHERE pac.fre_pac >= '$fechaDesde' AND pac.fre_pac <= '$fechaHasta'"); //Mediante esta línea, llamamos a la función ejecutar_sentencia, la cual requiere como parámetro la sentencia sql
//WHERE per.id_per = '".$id."'");//Mediante esta línea, llamamos a la función ejecutar_sentencia, la cual requiere como parámetro la sentencia sql
$localidad = mysqli_fetch_assoc($rs_localidades); //Mediante esta línea en la variable $localidad recibimos un arreglo con el resultado de la consulta



$codigoHTML='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>REPORTE DE CASOS DE INCIDENCIA Reporte de Incidencia</title>
</head>
<body>
<table class="tablaborde" border="1">
        <tr>
            <th class="encabezadolista">CEDULA</th>
            <th class="encabezadolista">NOMBRE</th>
            <th class="encabezadolista">APELLIDO</th>
            <th class="encabezadolista">ENFERMEDAD</th>
            <th class="encabezadolista">PRIORIDAD</th>
            <th class="encabezadolista">FECHA REGISTRO</th>
        </tr>';
  while($res = mysqli_fetch_assoc($rs_localidades)){
$codigoHTML.='	
	<tr>
		<td>'.$res['ced_per'].'</td>
		<td>'.$res['pno_per']." ".$res['sno_per'].'</td>
		<td>'.$res['apa_per']." ".$res['ama_per'].'</td>
		<td>'.$res['nom_enf'].'</td>
		<td>'.$res['pri_enf'].'</td>
		<td>'.$res['fre_pac'].'</td>										
	</tr>';
	
}
	

$codigoHTML.='
</table>
</body>
</html>';
$codigoHTML=utf8_encode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("Reporte_tabla_usuarios.pdf");
?>