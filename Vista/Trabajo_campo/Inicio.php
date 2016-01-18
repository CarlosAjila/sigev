<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloAdministrador.css" />
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloPaciente.css" />
<link rel="stylesheet" href="../../Estilos/fontello.css" />
<title>SIGEV - Trabajo de Campo</title>
</head>

<!--SECCIÓN PARA LA PRESENTACIÓN DEL MAPA-->
<script type="text/javascript" src="http://www.openlayers.org/api/OpenLayers.js"></script>
<script src="http://www.openlayers.org/dev/OpenLayers.js"></script>
<script type="text/javascript" src="http://www.openstreetmap.org/openlayers/OpenStreetMap.js"></script>   
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>  
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script> 
<!--Librerias para el uso de Jquery 1.11.3-->
<link rel="stylesheet" type="text/css" href="../../jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css" />
<script src="../../jquery-1.11.3/jquery-1.11.3.js"></script>
<script src="../../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#flotante').load('../../Contralador/Clista_paciente.php');
	});
</script>

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
                <a href="#" onclick="nuevo_marcador(1)" style="font-size:18px;">Punto de partida</a>
                <a href="#" onclick="buscar()" style="font-size:18px;">Destino</a>
                <a href="#" onclick="drawLine()" style="font-size:18px;">Ruta</a>
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
    <div id="dialogotrabajocampo">
    	<form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="FormTrabajoCampo" id="FormTrabajoCampo" enctype="multipart/form-data">
        	<table>
            	<tr>
                	<td><input type="text" name="id_pac" id="id_pac" disabled="disabled"/></td>
                </tr>
                
                <tr>
                	<td><input type="text" name="nombre_paciente" id="nombre_paciente" disabled="disabled"/></td>
                </tr>
                
                <tr>
                	<td>Número de Personas<input type="text" name="" id=""/></td>
                </tr>
                
                 <tr>
                	<td>Tipo de Criadero
                    	<select name="tipo_criadero"id="tipo_criadero">
                    		<option>Aedes</option>
                            <option>Cules</option>
                            <option>Anofeles</option>
                        </select>
                    </td>
                </tr>
				  <tr>
                	<td>Sector Endémico<input type="text" name="" id=""/></td>
                </tr>
                
                  <tr>
                	<td>Observación<textarea id="observacion" name="observacion" cols="50" rows="5" class=""></textarea></td>
                </tr>
                <tr>
                	<td>Tipo de Máquina<input type="text" name="" id=""/></td>
                </tr>
                 <tr>
                	<td>Tipo de Químico<input type="text" name="" id=""/></td>
                </tr>
                 <tr>
                	<td>Cantidad de Químico<input type="text" name="" id=""/></td>
                </tr>
                 <tr>
                	<td>Criterio Técnico<textarea id="criterio_tecnico" name="criterio_tecnico" cols="50" rows="5" class=""></textarea></td>
                </tr>
                <tr valign="baseline">
                  <td align="right" nowrap bgcolor="#FFFF99"><div align="left"><em><strong>Imagen:</strong></em></div></td>
                  <td valign="middle" bgcolor="#FFFF99">
                  <label>
                    <input name="Foto" type="file" id="Foto">
                  </label></td>
                  
                </tr>
            </table>
        </form>
    </div>
    <div id="ruta">
    </div>
    <div id="flotante">
    	
    </div>
</div>
</body>
</html>