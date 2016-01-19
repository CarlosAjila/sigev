<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloAdministrador.css" />
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloPaciente.css" />
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloRegistrar.css" />
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
<script src="../../AjaxUpload.2.0.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#flotante').load('../../Contralador/Clista_paciente.php');
	});
</script>

<script language="javascript">
//Evento que se disparará cuando se vaya a cargar una foto de perfil
$(function(){
	var btnUpload=$('#btimagen');
	var status=$('#status');
	new AjaxUpload(btnUpload, {
		action: '../../Contralador/CargarFoto.php',
		name: 'uploadfile',
		dataType:'json',
		onSubmit: function(file){
			$('#load').attr('class','imagensi');
			status.text('Cargando...');
		},
		onComplete: function(file, response){
			//Parseamos el array JSON
			var respuesta = $.parseJSON(response);
			alert(respuesta.mensaje);
			status.text('');
			$('#fotoPerfil').removeAttr('src');
			$('#fotoPerfil').attr('src','../'+respuesta.ruta);
			$('#ruta_imagen').attr('value','../'+respuesta.ruta);
			$('#load').attr('class','imagenno');
		}
	});
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
        	<table  class="contenedor">
            	<tr>
        			<td colspan="2" align="center">
            			<img id="fotoPerfil" src="../../imagenes/fotoperfil.jpg" class="bordefoto" />
            			<input type="hidden" id="ruta_imagen" name="ruta_imagen" value="" />
            		</td>
        		</tr>
        		<tr>
        			<td colspan="2" align="center">
            			<img id="load" src="../../imagenes/load.gif" class="imagenno">
						<span id="status"></span>
            		</td>
        		</tr>
        		<tr>
        			<td colspan="2" align="center">
            			<input type="button" id="btimagen" value="Cargar Imagen" />
                        
            		</td>
        		</tr>
                <tr >
                	<td colspan ="2">
                		<input type="text" name="id_pac" id="id_pac" disabled="disabled" size="2"/>
                        <input type="text" name="nom_paciente" id="nom_paciente" disabled="disabled"/>
                    
                    </td>                                                                               	
                   
                </tr>
                                                              
                <tr>
                	<td align="left"><strong>Número de Personas:</strong></td>
                	<td><input type="text" name="num_personas" id="num_personas" size="3"/></td>
                </tr>
                
                 <tr>
                 	<td align="left"><strong>Tipo de Criadero:</strong></td>
                	<td>
                    	<select name="tipo_criadero"id="tipo_criadero">
                    		<option>Aedes</option>
                            <option>Cules</option>
                            <option>Anofeles</option>
                        </select>
                    </td>
                </tr>
				  <tr>
                  	<td align="left"><strong>Sector Endémico:</strong></td>
                	<td><input type="text" name="sector" id="sector"/></td>
                </tr>
                
                 <tr>
                  	<td align="left"><strong>Observación:</strong></td>
                	<td><textarea id="observacion" name="observacion" cols="25" rows="3" class=""></textarea></td>
                </tr>
                <tr>
                	<td align="left"><strong>Tipo de Máquina:</strong></td>
                	<td><input type="text" name="tipo_maquina" id="tipo_maquina"/></td>
                </tr>
                 <tr>
                 	<td align="left"><strong>Tipo de Químico:</strong></td>
                	<td><input type="text" name="tipo_quimico" id="tipo_quimico"/></td>
                </tr>
                 <tr>
                 	<td align="left"><strong>Cantidad de Químico:</strong></td>
                	<td><input type="text" name="cant_quimico" id="cant_quimico" size="3"/></td>
                </tr>
                 <tr>
                	<td align="left"><strong>Criterio Técnico:</strong></td>
                    <td><textarea id="criterio_tecnico" name="criterio_tecnico" cols="25" rows="5" class=""></textarea></td>
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