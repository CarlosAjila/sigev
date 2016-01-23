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
<script src="../../Validaciones/Validacion.js"></script>
<title>SIGEV-Registro Cuenta Usuario</title>

<script language="javascript">
//Evento que se disparará cuando se vaya a cargar una foto de perfil
$(function(){
	var btnUpload=$('#btimagen');
	var status=$('#status');
	new AjaxUpload(btnUpload, {
		action: '../../Contralador/CargarFoto.php',
		name: 'file',
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
	$('#txtnusuario').val("");
	$('#txtpass').val("");
	$('#btguardar').click(function() {
		$('input:radio[name=sex_per]:checked').val();
		var ruta = "../../Contralador/Usuario.php";	
		var isNotOk;
		var cedu=window.document.FormRegistro.txtcedula.value;
		
		if(cedu=="")
		{
			alert("Debe Ingresar el # Cedula")
			document.FormRegistro.txtcedula.focus();
			return false;
			isNotOk=true;
		}
		
		var numero = window.document.FormRegistro.txtcedula.value;
		if(cedu!="")
		{
		var suma = 0;
		var p1=0;
		var residuo = 0;
		var pri = false;
		var pub = false;
		var nat = false;
		var numeroProvincias = 22;
		var modulo = 11;
		
		/* Verifico que el campo no contenga letras */
		var ok=1;
		for (i=0; i; numeroProvincias){
		alert("El c"+'\u00f3'+"digo de la provincia (dos primeros dígitos) es inv"+'\u00e1'+"lido"); 
		document.FormRegistro.txtcedula.focus();
		return false;
		}
		
		/* Aqui almacenamos los digitos de la cedula en variables. */
		d1 = numero.substr(0,1);
		d2 = numero.substr(1,1);
		d3 = numero.substr(2,1);
		d4 = numero.substr(3,1);
		d5 = numero.substr(4,1);
		d6 = numero.substr(5,1);
		d7 = numero.substr(6,1);
		d8 = numero.substr(7,1);
		d9 = numero.substr(8,1);
		d10 = numero.substr(9,1); 
		
		/* El tercer digito es: */
		/* 9 para sociedades privadas y extranjeros */
		/* 6 para sociedades publicas */
		/* menor que 6 (0,1,2,3,4,5) para personas naturales */ 
		
		if (d3==7 || d3==8){
		alert("El tercer d"+'\u00ed'+"gito ingresado es inv"+'\u00e1'+"lido");
		document.FormRegistro.txtcedula.focus();
		return false;
		} 
		
		/* Solo para personas naturales (modulo 10) */
		if (d3 < 6){
		nat = true;
		p1 = d1 * 2; if (p1 >= 10) p1 -= 9;
		p2 = d2 * 1; if (p2 >= 10) p2 -= 9;
		p3 = d3 * 2; if (p3 >= 10) p3 -= 9;
		p4 = d4 * 1; if (p4 >= 10) p4 -= 9;
		p5 = d5 * 2; if (p5 >= 10) p5 -= 9;
		p6 = d6 * 1; if (p6 >= 10) p6 -= 9;
		p7 = d7 * 2; if (p7 >= 10) p7 -= 9;
		p8 = d8 * 1; if (p8 >= 10) p8 -= 9;
		p9 = d9 * 2; if (p9 >= 10) p9 -= 9;
		modulo = 10;
		} 
		
		/* Solo para sociedades publicas (modulo 11) */
		/* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
		else if(d3 == 6){
		pub = true;
		p1 = d1 * 3;
		p2 = d2 * 2;
		p3 = d3 * 7;
		p4 = d4 * 6;
		p5 = d5 * 5;
		p6 = d6 * 4;
		p7 = d7 * 3;
		p8 = d8 * 2;
		p9 = 0;
		} 
		
		/* Solo para entidades privadas (modulo 11) */
		else if(d3 == 9) {
		pri = true;
		p1 = d1 * 4;
		p2 = d2 * 3;
		p3 = d3 * 2;
		p4 = d4 * 7;
		p5 = d5 * 6;
		p6 = d6 * 5;
		p7 = d7 * 4;
		p8 = d8 * 3;
		p9 = d9 * 2;
		}
		
		suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
		residuo = suma % modulo; 
		
		/* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
		digitoVerificador = residuo==0 ? 0: modulo - residuo; 
		
		/* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/
		if (pub==true){
		if (digitoVerificador != d9){
		alert("El ruc de la empresa del sector p"+'\u00fa'+"blico es incorrecto.");
		document.FormRegistro.txtcedula.focus();
		return false;
		}
		/* El ruc de las empresas del sector publico terminan con 0001*/
		if ( numero.substr(9,4) != '0001' ){
		alert("El ruc de la empresa del sector p"+'\u00fa'+"blico debe terminar con 0001");
		document.FormRegistro.txtcedula.focus();
		return false;
		}
		}
		else if(pri == true){
		if (digitoVerificador != d10){
		alert('El ruc de la empresa del sector privado es incorrecto.');
		document.FormRegistro.txtcedula.focus();
		return false;
		}
		if ( numero.substr(10,3) != '001' ){
		alert('El ruc de la empresa del sector privado debe terminar con 001');
		document.FormRegistro.txtcedula.focus();
		return false;
		}
		} 
		
		else if(nat == true){
		if (digitoVerificador != d10){
		alert("El n"+'\u00fa'+"mero de c"+'\u00e9'+"dula de la persona natural es incorrecto.");
		document.FormRegistro.txtcedula.focus();
		document.FormRegistro.txtcedula = "";
		return false;
		isNotOk=true;
		}
		
		if (numero.length >10 && numero.substr(10,3) != '001' ){
		alert('El ruc de la persona natural debe terminar con 001');
		document.FormRegistro.txtcedula.focus();
		return false;
		}
		}
		}
		
		var isNotOk;
		var pno=window.document.FormRegistro.txtpnombre.value;
		if(pno=="")
		{
			alert("Debe ingresar su primer nombre")
			document.FormRegistro.txtpnombre.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var sno=window.document.FormRegistro.txtsnombre.value;
		if(sno=="")
		{
			alert("Debe ingresar su segundo nombre")
			document.FormRegistro.txtsnombre.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var apa=window.document.FormRegistro.txtapaterno.value;
		if(apa=="")
		{
			alert("Debe ingresar su apellido paterno")
			document.FormRegistro.txtapaterno.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var ama=window.document.FormRegistro.txtamaterno.value;
		if(ama=="")
		{
			alert("Debe ingresar su apellido materno")
			document.FormRegistro.txtamaterno.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var bar=window.document.FormRegistro.txtlocalidad.value;
		if(bar=="")
		{
			alert("Debe ingresar su barrio de domicilio")
			document.FormRegistro.txtlocalidad.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var ema=window.document.FormRegistro.txtemail.value;
		if(ema=="")
		{
			alert("Debe ingresar su correo electrónico")
			document.FormRegistro.txtemail.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var usu=window.document.FormRegistro.txtnusuario.value;
		if(usu=="")
		{
			alert("Debe ingresar su nombre de usuario")
			document.FormRegistro.txtnusuario.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var con=window.document.FormRegistro.txtpass.value;
		if(con=="")
		{
			alert("Debe ingresar su contraseña")
			document.FormRegistro.txtpass.focus();
			return false;
			isNotOk=true;
		}
		
		if(isNotOk)
		{
			return false;
		}
		else
		{
			$.ajax({
				url:ruta,
				type:'POST',
				dataType:'json',
				data: $('#FormRegistro').serialize(),
				success: function(json){
					//Parseamos el array JSON
					alert(json.mensaje);
				}
			});
		}
	});
});
</script>

<script language="javascript">
//Sección para el autocompletado
$(document).ready(function(){
	$('#txtlocalidad').autocomplete({
		source:"../../Contralador/Localizacion.php",
		select: function(event, ui){
			$('#id_loc').val(ui.item.id_loc);
		}
	});
});
</script>
</head>

<body>
<div id="cabecera">
<table width="100%"><tr><td align="left"><img src="../../imagenes/lbanner-05.png" style="width:180px; height:50px;" /></td><td align="right"><a href="../../Inicio.php"><img src="../../imagenes/botoninicio.png" style="width:180px; height:50px;" /></a></td></tr></table>
</div>
<div id="titulo">
	Registrar una cuenta nueva
</div>
<div id="campos">
<form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="FormRegistro" id="FormRegistro" enctype="multipart/form-data">
	<input id="save_usuario" name="save_usuario" type="hidden" value="save_usuario"/>
    <table class="contenedor" border="1" style="border:1px solid #000; border-collapse:collapse;">
    	<tr>
        	<td colspan="2" align="center" valign="top">
            	<table>
                	<tr>
                    	<td align="center" style="background-color:#036; color:#FFF; font-weight:bold;">
                        	Foto de perfil
                        </td>
                    </tr>
                	<tr>
                    	<td align="center">
                        	<img id="fotoPerfil" src="../../imagenes/fotoperfil.jpg" style="border:1px solid #000;" width="120px" height="130px" />
            				<input type="hidden" id="ruta_imagen" name="ruta_imagen" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <img id="load" src="../../imagenes/cargando.gif" class="imagenno">
                            <span id="status"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="button" id="btimagen" value="Cargar Imagen" />
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-style:italic; font-weight:bold; font-size:14px;" align="center">
                        	La foto de perfil debe ser de tamaño carnet.
                        </td>
                    </tr>
                </table>
            </td>
            <td>
            	<table>
                	<tr>
                        <td style="background-color:#036; color:#FFF; font-weight:bold;" align="left">Datos Personales</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtcedula" id="txtcedula" placeholder="Número de cédula" class="cajatextoregistro" onkeypress="return validar_num(event)" maxlength="10" /></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtfn" id="txtfn" placeholder="Fecha de nacimiento" class="cajatextoregistro" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtpnombre" id="txtpnombre" placeholder="Primer nombre" class="cajatextoregistro" onkeypress="return validar(event)"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtsnombre" id="txtsnombre" placeholder="Segundo nombre" class="cajatextoregistro" onkeypress="return validar(event)"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtapaterno" id="txtapaterno" placeholder="Apellido paterno" class="cajatextoregistro" onkeypress="return validar(event)"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtamaterno" id="txtamaterno" placeholder="Apellido materno" class="cajatextoregistro" onkeypress="return validar(event)"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtcel" id="txtcel" placeholder="Número de celular" class="cajatextoregistro" onkeypress="return validar_num(event)"/></td>
                    </tr>
                    <tr>
                       <td><input type="text" name="txttel" id="txttel" placeholder="Número de teléfono" class="cajatextoregistro" onkeypress="return validar_num(event)"/></td>
                    </tr>
                    <tr>
                    	<td align="left">Sexo: 
                            <input type="radio" name="sex_per" id="sex_per" value="M"> Masculino
                            <input type="radio" name="sex_per" id="sex_per" value="F"> Femenino
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="text" name="txtemail" id="txtemail" placeholder="Email" class="cajatextoregistro"/></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="txtlocalidad" id="txtlocalidad" placeholder="Ingrese el nombre de su sector" class="cajatextoregistro"/>
                            <input type="hidden" name="id_loc" id="id_loc" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color:#036; color:#FFF; font-weight:bold;" align="left">Datos de usuario</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtnusuario" id="txtnusuario" placeholder="Nombre de usuario" class="cajatextoregistro"/></td>
                    </tr>
                    <tr>
                       <td><input type="password" name="txtpass" id="txtpass" placeholder="Contraseña" class="cajatextoregistro"/></td>
                    </tr>
               </table>
            </td>
        </tr>
     </table>
     <table>
     	<tr>
            <td colspan="3"><input type="button" name="btguardar" id="btguardar" class="imagenguardar"/></td>
        </tr>
        <tr>
            <td colspan="3">Guardar</td>
        </tr>
     </table>
</form>
</div>
</body>
</html>
