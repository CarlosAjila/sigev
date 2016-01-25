<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" charset="utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloAdministrador.css" />
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloPaciente.css" />
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloRegistrar.css" />
<link rel="stylesheet" href="../../Estilos/fontello.css" />
<title>SIGEV - Estadística</title>
</head>


<!--SECCIÓN PARA LA PRESENTACIÓN DEL MAPA-->
<script type="text/javascript" src="http://www.openlayers.org/api/OpenLayers.js"></script>
<script src="http://www.openlayers.org/dev/OpenLayers.js"></script>
<script type="text/javascript" src="http://www.openstreetmap.org/openlayers/OpenStreetMap.js"></script>   
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>  
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css" />
<script src="../../jquery-1.11.3/jquery-1.11.3.js"></script>
<script src="../../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
<script src="../../Validaciones/Validacion.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#flotante').load('../../Contralador/Clista_paciente.php');
	});
</script>

</script>
<?php include("../../Contralador/mapa.php"); ?>

<body onload="init()">
<div id="contenedor">
    <header>
        <div>
            <h1><img src="../../imagenes/lbanner-05.png" class="logo"/></h1>
            <input type="checkbox" id="menu-bar" />
            <label class="icon-menu" for="menu-bar"></label>
             
            <nav class="menu">
                <a href="#" style="font-size:18px;">Inicio</a>
                <a href="../Paciente/Listar.php" style="font-size:18px;">Paciente</a>
                <a href="../Paciente/Reporte_lista_caso_paciente.php" style="font-size:18px;">Reportes</a>
                <a href="#" onclick="ubicacion()" style="font-size:18px;">Ubicacion</a>
                <a href="#" onclick="nuevo_paciente(1)" style="font-size:18px;">Registrar Paciente</a>
                <a href="#" onclick="nuevo_marcador(1)" style="font-size:18px;">Punto de partida</a>
                <a href="#" onclick="drawLine(3)" style="font-size:18px;">Ruta</a>
            </nav>
        </div>
    </header>
    <div id="map">
     
    </div>
    <div id="dialogoformulario" title="Registro de Pacientes" style="display:none;">
         <?php include("../../Vista/Paciente/Registrar_paciente.php"); ?>
    </div>
    <div id="dialogotrabajocampo">
    	<form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="FormTrabajoCampo" id="FormTrabajoCampo" enctype="multipart/form-data">
        	<table>
            	<tr>
                	<td><input type="text" name="id_pac" id="id_pac"/></td>
                    <td><input type="text" name="nombre_paciente" id="nombre_paciente"/></td>
                </tr>
            </table>
        </form>
    </div>
    <div id="ruta">
    </div>
    <div id="flotante">
    	 <?php include("../../Vista/Paciente/Editar_paciente.php"); ?>
    </div>
</div>
</body>
</html>