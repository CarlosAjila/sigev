<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloAdministrador.css" />
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloPaciente.css" />
<link rel="stylesheet" href="../../Estilos/fontello.css" />
<title>SIGEV - Administrador</title>
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
		$('#leyendaflotante').load();
		$('#barriosflotante').load();
	});
	$(function(){
	 	$("input[name='file']").on('change', function(){																		
			var formData = new FormData($("#FormPerfil")[0]);
			var ruta = "../../Contralador/CargarFoto.php";
			$.ajax({
					url: ruta,					
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					success: function(datos)
					{
						var respuesta = $.parseJSON(datos);
						//alert(respuesta.ruta);
						$("#respuesta").html(respuesta);
						$('#ruta_imagen').val(respuesta.ruta);
						$('#imagen').attr('src','../'+respuesta.ruta);
						
					}
					
			});									
		});	
	});

//Para el manejo de fechas
var opciones_datepicker={ changeYear: true,
			dateFormat: "yy-mm-dd",
			monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
			dayNames: [ "Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado" ],
			dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
			yearRange:"1950:2050"
};
$(document).ready(function(e) {
$('#txtfna').datepicker(opciones_datepicker);
});
</script>
<script language="javascript">
$(document).ready(function() {
	$('#bteperfil').click(function(e) {
    	var ruta = "../../Contralador/Usuario.php";	
		$.ajax({
			url:ruta,
			type:'POST',
			dataType:'json',
			data: $('#FormPerfil').serialize(),
			success: function(data){
           		//Parseamos el array JSON
				alert(data.mensaje);
				//document.getElementById('FormPerfil').submit(); 
           	}
		});
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
                <a href="#" onclick="drawLine()" style="font-size:18px;">Ruta</a>
                <a href="#" onclick="editar_perfil()" style="font-size:18px;">Perfil</a>
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
    
    <div id="ruta">
    </div>
    <div id="flotante">
    </div>
  
    <div id="dialogoperfil" title="Editar Perfil">
    	<form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="FormPerfil" id="FormPerfil" enctype="multipart/form-data">
        <input type="hidden" name="editar_perfil" id="editar_perfil" value="editar_perfil" />
            <table border="1">
            	<tr>
                	<td valign="top">
                    	<table border="1">
                        	<tr>
                            	<td align="center">Foto de perfil</td>
                            </tr>
                            <tr>
                            	<td style="font-size:12px;">
                                <input type="file"  name="file" > 
                           		<input type="hidden" id="ruta_imagen" name="ruta_imagen" value="" />
                           		<img id ="imagen" src="<?php echo $_SESSION['fot_usu'];?>" width="120px" height="130px"/>
                           		<div id="respuesta">
                          		</div>  
                                </td>
                            </tr>
                            <tr>
                            	<td style="font-size:12px"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                    	<table border="1">
                        	<tr>
                            	<td>Cédula</td><td><input type="text" name="txtcedula" id="txtcedula" value="<?php echo $_SESSION['ced_per'];?>" /></td>
                            </tr>
                            <tr>
                            	<td>Primer nombre:</td><td><input type="text" name="txtpnombre" id="txtpnombre" value="<?php echo $_SESSION['pno_per'];?>" /></td>
                            </tr>
                            <tr>
                            	<td>Segundo nombre:</td><td><input type="text" name="txtsnombre" id="txtsnombre" value="<?php echo $_SESSION['sno_per'];?>" /></td>
                            </tr>
                            <tr>
                            	<td>Apellido paterno:</td><td><input type="text" name="txtapaterno" id="txtapaterno" value="<?php echo $_SESSION['apa_per'];?>" /></td>
                            </tr>
                            <tr>
                            	<td>Apellido materno:</td><td><input type="text" name="txtamaterno" id="txtamaterno" value="<?php echo $_SESSION['ama_per'];?>" /></td>
                            </tr>
                            <tr>
                            	<td>Teléfono 1:</td><td><input type="text" name="txtte1" id="txtte1" value="<?php echo $_SESSION['te1_per'];?>" /></td>
                            </tr>
                            <tr>
                            	<td>Teléfono 2:</td><td><input type="text" name="txtte2" id="txtte2" value="<?php echo $_SESSION['te2_per'];?>" /></td>
                            </tr>
                            <tr>
                            	<td>Fecha de nacimiento:</td><td><input type="text" name="txtfna" id="txtfna" value="<?php echo $_SESSION['fna_per'];?>" /></td>
                            </tr>
                            <tr>
                            	<td>Residencia:</td><td><input type="text" name="txtresidencia" id="txtresidencia" value="<?php echo $_SESSION['nom_loc'];?>" /></td>
                            </tr>
                            <tr>
                            	<td>Email:</td><td><input type="text" name="txtemail" id="txtemail" value="<?php echo $_SESSION['ema_usu'];?>" /></td>
                            </tr>
                            <tr>
                            	<td>Usuario:</td><td><input type="text" name="txtusuario" id="txtusuario" value="<?php echo $_SESSION['nus_usu'];?>" /></td>
                            </tr>
                            <tr>
                            	<td>Contraseña:</td><td><input type="text" name="txtpass" id="txtpass" value="<?php echo $_SESSION['con_usu'];?>" />
                                <input type="hidden" name="id_usu" id="id_usu" value="<?php echo $_SESSION['id_usu'];?>" />
                                <input type="hidden" name="id_per" id="id_per" value="<?php echo $_SESSION['id_per'];?>" /></td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
                <tr>
                            	<td colspan="2" align="center"><input type="button" name="bteperfil" id="bteperfil" value="Editar" /></td>
                            </tr>
            </table>
        </form>
        <div id="fot">
        </div>
        
    </div>
    </div>
</div>
</body>
</html>