<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloAdministrador.css" />
<link rel="stylesheet" href="../../Estilos/fontello.css" />
<title>SIGEV - Administrador</title>
</head>

<!--SECCIÓN PARA LA PRESENTACIÓN DEL MAPA-->
<script type="text/javascript" src="http://www.openlayers.org/api/OpenLayers.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>  
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script> 
<!--Librerias para el uso de Jquery 1.11.3-->
<link rel="stylesheet" type="text/css" href="../../jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css" />
<script src="../../jquery-1.11.3/jquery-1.11.3.js"></script>
<script src="../../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
<?php include("../../Contralador/mapa.php"); ?>

<body onload="init()">
<div id="contenedor">
    <header>
        <div class="contenedor">
            <h1><img src="../../imagenes/lbanner-05.png" class="logo" /></h1>
            <input type="checkbox" id="menu-bar" />
            <label class="icon-menu" for="menu-bar"></label>
            <nav class="menu">
                <a href="#" style="font-size:18px;" class="icon-inicio">Inicio</a>
                <a href="../Usuario/Listar.php" style="font-size:18px;" class="icon-iniciar-sesion">Usuarios</a>
                <a href="#" onclick="ubicacion()" style="font-size:18px;">Ubicacion</a>
                <a href="#" onclick="nuevo_paciente(1)" style="font-size:18px;">Registrar Paciente</a>
            </nav>
        </div>
    </header>
    <div id="map">
    </div>
    <div id="dialogoformulario" title="Registro de Pacientes" style="display:none;">
    <form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="FormRegistroP" id="FormRegistroP" enctype="multipart/form-data">
    	<input type="text" name="longitud" id="longitud" value="" />
        <input type="text" name="latitud" id="latitud" value="" />
        <input type="button" name="bt_guardar" id="bt_guardar" value="Guardar" />
        <input type="hidden" name="save_paciente" id="save_paciente" value="save_paciente" />
    </form>
    </div>
</div>
</body>
</html>