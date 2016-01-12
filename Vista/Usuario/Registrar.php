<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloRegistrar.css" />
<link rel="stylesheet" type="text/css" href="../../jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css" />
<script src="../../jquery-1.11.3/jquery-1.11.3.js"></script>
<script src="../../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
<script src="../../AjaxUpload.2.0.min.js"></script>
<title>SIGEV-Registro Cuenta Usuario</title>

<script>
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

//Para el manejo de fechas
var opciones_datepicker={ changeYear: true,
			dateFormat: "yy-mm-dd",
			monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
			dayNames: [ "Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado" ],
			dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
			yearRange:"1950:2050"
};
$(document).ready(function(e) {
	$('#txtfn').datepicker(opciones_datepicker);
	$('#txtffc').datepicker(opciones_datepicker);
});
</script>

﻿<script language="javascript">
$(document).ready(function(){
	$('#btguardar').click(function() {
		//alert('hola');
		var ruta = "../../Contralador/Usuario.php";	
		$.ajax({
			url:ruta,
			type:'POST',
			dataType:'json',
			data: $('#FormRegistro').serialize(),
			success: function(data){
				//alert('hola');
           		//Parseamos el array JSON
				alert(data.cargo);
				alert(data.cedula);
				alert(data.pnombre);
				alert(data.snombre);
				alert(data.apaterno);
				alert(data.amaterno);
				alert(data.fecha_nacimiento);
				alert(data.cel);
				alert(data.tel);
				alert(data.ruta_imagen);
				alert(data.nusuario);
				alert(data.pass);
				alert(data.email);
				alert(data.ffc);
				alert(data.estado);
			   //$('#resultado').html(datos); // Mostrar la respuestas del script PHP.
           	}
		});
	});
});
</script>

<script language="javascript">
//Sección para el autocompletado
$(document).ready(function(){
	$('#txtcargo').autocomplete({
		source:['Jose','Juan','Ojeda']
	});
});
</script>
</head>

<body bgcolor="#67ADF3">
<div id="cabecera">
<img src="../../imagenes/lbanner-05.png" style="width:240px; height:80px;" />
</div>
<div id="titulo">
	Registrar una cuenta nueva
</div>
<div id="campos">
<form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="FormRegistro" id="FormRegistro" enctype="multipart/form-data">
	<input id="save_usuario" name="save_usuario" type="hidden" value="save_usuario"/>
    <table class="contenedor" border="1">
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
        <tr>
            <td><input type="text" name="txtcedula" id="txtcedula" placeholder="Número de cédula" class="cajatexto" /></td>
        	<td><input type="text" name="txtfn" id="txtfn" placeholder="Fecha de nacimiento" class="cajatexto" readonly="readonly"/></td>
        </tr>
        <tr>
            <td><input type="text" name="txtpnombre" id="txtpnombre" placeholder="Primer nombre" class="cajatexto"/></td>
            <td><input type="text" name="txtsnombre" id="txtsnombre" placeholder="Segundo nombre" class="cajatexto"/></td>
        </tr>
        <tr>
            <td><input type="text" name="txtapaterno" id="txtapaterno" placeholder="Apellido paterno" class="cajatexto"/></td>
            <td><input type="text" name="txtamaterno" id="txtamaterno" placeholder="Apellido materno" class="cajatexto"/></td>
        </tr>
        <tr>
            <td><input type="text" name="txtcel" id="txtcel" placeholder="Número de celular" class="cajatexto"/></td>
        	<td><input type="text" name="txttel" id="txttel" placeholder="Número de teléfono" class="cajatexto"/></td>
        </tr>
        <tr>
            <td colspan="3"><input type="text" name="txtemail" id="txtemail" placeholder="Email" class="email" /></td>
        </tr>
        <tr>
            <td><input type="text" name="txtnusuario" id="txtnusuario" placeholder="Nombre de usuario" class="cajatexto"/></td>
            <td><input type="text" name="txtpass" id="txtpass" placeholder="Contraseña" class="cajatexto"/></td>
        </tr>
        <tr>
            <td><input type="text" name="txtcargo" id="txtcargo" placeholder="Cargo" class="cajatexto"/></td>
            <td><input type="text" name="txtffc" id="txtffc" placeholder="Fecha de fin de contrato" class="cajatexto"/></td>
        </tr>
        <tr>
            <td colspan="3"><input type="button" name="btguardar" id="btguardar" value="GUARDAR"/></td>
        </tr>
    </table>
</form>
</div>
</body>
</html>
