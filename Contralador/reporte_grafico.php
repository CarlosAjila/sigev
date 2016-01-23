<?php
//require_once("../dompdf/dompdf_config.inc.php");
//function conectar_servidor() {
//    $hostname_conexion = "localhost";
//    $username_conexion = "root";
//    $password_conexion = "";
//    $conexion = mysqli_connect($hostname_conexion, $username_conexion, $password_conexion, "reportes_graficos_db") or trigger_error(mysql_error(), E_USER_ERROR);
////    $conexion = mysqli_connect($hostname_conexion, $username_conexion, $password_conexion, "bd_sigev") or trigger_error(mysql_error(), E_USER_ERROR);
//    return $conexion;
//}

mysql_connect("Localhost", "root", "");
mysql_select_db("bd_sigev");



//$fechaDesde = $_POST['txtfechaDesde'];
//$fechaHasta = $_POST['txtfechaHasta'];
$fechaDesde = "2016-01-18";
$fechaHasta = "2016-01-23";


//$rs_localidades = ejecutar_sentencia("SELECT  pac.fre_pac ,enf.nom_enf,COUNT(enf.nom_enf)
//FROM persona per INNER JOIN paciente pac ON per.id_per = pac.id_per 
//INNER JOIN paciente_enfermedad pae ON pae.id_pac = pac.id_pac 
//INNER JOIN enfemedad enf ON enf.id_enf = pae.id_enf 
//WHERE pac.fre_pac >= '$fechaDesde' AND pac.fre_pac <= '$fechaHasta'
//GROUP BY enf.nom_enf");
//$localidad = mysqli_fetch_assoc($rs_localidades);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
            #container {
                height: 400px; 
                min-width: 310px; 
                max-width: 800px;
                margin: 0 auto;
            }
        </style>
        <script type="text/javascript">
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column',
                        margin: 95,
                        options3d: {
                            enabled: true,
                            alpha: 10,
                            beta: 25,
                            depth: 70
                        }
                    },
                    title: {
                        text: '3D chart with null values'
                    },
                    subtitle: {
                        text: 'Notice the difference between a 0 value and a null point'
                    },
                    plotOptions: {
                        column: {
                            depth: 25
                        }
                    },
                    xAxis: {
                        categories: [
<?php
//$sql = mysql_query("select * from deudas order by monto_deudor desc");
$sql = mysql_query("SELECT  pac.fre_pac ,enf.nom_enf,COUNT(enf.nom_enf)
FROM persona per INNER JOIN paciente pac ON per.id_per = pac.id_per 
INNER JOIN paciente_enfermedad pae ON pae.id_pac = pac.id_pac 
INNER JOIN enfemedad enf ON enf.id_enf = pae.id_enf 
WHERE pac.fre_pac >= '$fechaDesde' AND pac.fre_pac <= '$fechaHasta'
GROUP BY enf.nom_enf");
while ($res = mysql_fetch_array($sql)) {
//    echo $res['nom_enf'];
    ?>

                                ['<?php echo $res['nom_enf']." ".$res['fre_pac']; ?>'],
    <?php
}
?>
                        ]
                    },
                    yAxis: {
                        title: {
                            text: null
                        }
                    },
                    series: [{
                            name: 'Casos',
                            data: [
<?php
//$sql = mysql_query("select * from deudas order by monto_deudor desc");
$sql = mysql_query("SELECT  pac.fre_pac ,enf.nom_enf,COUNT(enf.nom_enf) as casos
FROM persona per INNER JOIN paciente pac ON per.id_per = pac.id_per 
INNER JOIN paciente_enfermedad pae ON pae.id_pac = pac.id_pac 
INNER JOIN enfemedad enf ON enf.id_enf = pae.id_enf 
WHERE pac.fre_pac >= '$fechaDesde' AND pac.fre_pac <= '$fechaHasta'
GROUP BY enf.nom_enf");
while ($res = mysql_fetch_array($sql)) {
    ?>

                                    [<?php echo $res['casos'] ?>],
    <?php
}
?>
                            ]
                        }]
                });
            });
        </script>
    </head>
    <body>

        <script src="../Highcharts-4.1.5/js/highcharts.js"></script>
        <script src="../Highcharts-4.1.5/js/highcharts-3d.js"></script>
        <script src="../Highcharts-4.1.5/js/modules/exporting.js"></script>

        <div id="container" style="height: 400px"></div>
    </body>
</html>