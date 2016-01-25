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
<script src="../../Validaciones/Validacion.js"></script>

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

$(document).ready(function(e){
	$('#txtresidencia').autocomplete({
		source:"../../Contralador/Localizacion.php",
		select: function(event, ui){
			$('#id_loc').val(ui.item.id_loc);
		}
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
                <a href="../Visitadores/Listar.php" style="font-size:18px;" class="icon-iniciar-sesion">Visitadores</a>
                <a href="../Trabajo_campo/Listar_adm.php" style="font-size:18px;" class="icon-iniciar-sesion">Trabajos de campo</a>
                <a href="#" onclick="ubicacion()" style="font-size:18px;">Ubicacion</a>
                <a href="#" onclick="nuevo_marcador(1)" style="font-size:18px;">Punto de partida</a>
                <a href="#" onclick="drawLine(2)" style="font-size:18px;">Ruta</a>
                <a href="#" onclick="editar_perfil()" style="font-size:18px;">Perfil</a>
                <a href="../../cerrar_sesion.php" style="font-size:18px;">Cerrar sesión</a>
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
    	<?php include("../../Vista/Usuario/Perfil.php"); ?>
    </div>
    </div>
</div>
</body>
</html>