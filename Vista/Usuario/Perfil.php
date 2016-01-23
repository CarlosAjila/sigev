<script language="javascript">

    //Para el manejo de fechas
    var opciones_datepicker = {changeYear: true,
        dateFormat: "yy-mm-dd",
        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        dayNames: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        yearRange: "1950:2050"
    };
    $(document).ready(function (e) {
        $('#txtfna').datepicker(opciones_datepicker);
    });</script>

<script language="javascript">
    //Sección para el autocompletado
    $(document).ready(function () {
        $('#txtlocalidad').autocomplete({
            source: "../../Contralador/Localizacion.php",
            select: function (event, ui) {
                $('#id_loc').val(ui.item.id_loc);
            }
        });
    });
</script>

<script language="javascript">
$(document).ready(function() {
	
	$('#bteperfil').click(function(e) {
		var isNotOk;
		var ced=window.document.FormPerfil.txtcedula.value;
		if(ced=="")
		{
			alert("Debe Ingresar el # Cedula")
			document.FormPerfil.txtcedula.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var pno=window.document.FormPerfil.txtpnombre.value;
		if(pno=="")
		{
			alert("Debe ingresar su primer nombre")
			document.FormPerfil.txtpnombre.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var sno=window.document.FormPerfil.txtsnombre.value;
		if(sno=="")
		{
			alert("Debe ingresar su segundo nombre")
			document.FormPerfil.txtsnombre.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var apa=window.document.FormPerfil.txtapaterno.value;
		if(apa=="")
		{
			alert("Debe ingresar su apellido paterno")
			document.FormPerfil.txtapaterno.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var ama=window.document.FormPerfil.txtamaterno.value;
		if(ama=="")
		{
			alert("Debe ingresar su apellido materno")
			document.FormPerfil.txtamaterno.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var bar=window.document.FormPerfil.txtlocalidad.value;
		if(bar=="")
		{
			alert("Debe ingresar su barrio de domicilio")
			document.FormPerfil.txtlocalidad.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var ema=window.document.FormPerfil.txtemail.value;
		if(ema=="")
		{
			alert("Debe ingresar su correo electrónico")
			document.FormPerfil.txtemail.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var usu=window.document.FormPerfil.txtusuario.value;
		if(usu=="")
		{
			alert("Debe ingresar su nombre de usuario")
			document.FormPerfil.txtusuario.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var con=window.document.FormPerfil.txtpass.value;
		if(con=="")
		{
			alert("Debe ingresar su contraseña")
			document.FormPerfil.txtpass.focus();
			return false;
			isNotOk=true;
		}
		
		if(isNotOk)
		{
			return false;
		}
		else
		{
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
		}
	});
});
</script>

<form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="FormPerfil" id="FormPerfil" enctype="multipart/form-data">
    <input type="hidden" name="editar_perfil" id="editar_perfil" value="editar_perfil" />
    <table width="100%" border="1" style="border:1px solid #000; border-collapse:collapse;">
    	<tr>
        	<td valign="top" width="20%">
            	<table width="100%">
                	<tr><td align="center" style="background-color:#036; color:#FFF; font-weight:bold;">Foto de Perfil</td></tr>
                	<tr>
                        <td style="font-size:12px;" align="center">
                        <img id ="imagen" src="../<?php echo $_SESSION['fot_usu'];?>" width="120px" height="130px" style="border:1px solid #000;"/>
                        <div id="respuesta">
                        </div>  
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;" align="center">
                        <input type="file"  name="file" style="width:88px;"> 
                        <input type="hidden" id="ruta_imagen" name="ruta_imagen" value="<?php echo $_SESSION['fot_usu'];?>" />
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-style:italic; font-weight:bold; font-size:14px;" align="center">
                        	La foto de perfil debe ser de tamaño carnet.
                        </td>
                    </tr>
                </table>
            </td>
            <td align="left">
            	<table width="100%">
                	<tr><td colspan="3" style="background-color:#036; color:#FFF; font-weight:bold;">Datos Personales</td></tr>
                	<tr>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#F00;" width="1%">*</td><td width="27%" style="font-weight:bold;">Cédula</td><td><input type="text" name="txtcedula" id="txtcedula" value="<?php echo $_SESSION['ced_per'];?>" style="width:100%;" maxlength="10" onkeypress="return validar_num(event)" /></td>
                    </tr>
                    <tr>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#F00;">*</td><td style="font-weight:bold;">Primer nombre:</td><td><input type="text" name="txtpnombre" id="txtpnombre" value="<?php echo $_SESSION['pno_per'];?>" style="width:100%;" onkeypress="return validar(event)" /></td>
                    </tr>
                    <tr>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#F00;">*</td><td style="font-weight:bold;">Segundo nombre:</td><td><input type="text" name="txtsnombre" id="txtsnombre" value="<?php echo $_SESSION['sno_per'];?>" style="width:100%;" onkeypress="return validar(event)" /></td>
                    </tr>
                    <tr>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#F00;">*</td><td style="font-weight:bold;">Apellido paterno:</td><td><input type="text" name="txtapaterno" id="txtapaterno" value="<?php echo $_SESSION['apa_per'];?>" style="width:100%;" onkeypress="return validar(event)" /></td>
                    </tr>
                    <tr>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#F00;">*</td><td style="font-weight:bold;">Apellido materno:</td><td><input type="text" name="txtamaterno" id="txtamaterno" value="<?php echo $_SESSION['ama_per'];?>" style="width:100%;" onkeypress="return validar(event)" /></td>
                    </tr>
                    <tr>
                        <td></td><td style="font-weight:bold;">Teléfono 1:</td><td><input type="text" name="txtte1" id="txtte1" value="<?php echo $_SESSION['te1_per'];?>" style="width:100%;" onkeypress="return validar_num(event)" /></td>
                    </tr>
                    <tr>
                        <td></td><td style="font-weight:bold;">Teléfono 2:</td><td><input type="text" name="txtte2" id="txtte2" value="<?php echo $_SESSION['te2_per'];?>" style="width:100%;" onkeypress="return validar_num(event)" /></td>
                    </tr>
                    <tr>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#F00;">*</td><td style="font-weight:bold;">Fecha de nacimiento:</td><td><input type="text" name="txtfna" id="txtfna" value="<?php echo $_SESSION['fna_per'];?>" style="width:100%;" /></td>
                    </tr>
					<tr>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#F00;">*</td><td colspan="2" style="font-weight:bold;">Barrio:</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="text" name="txtlocalidad" id="txtlocalidad" placeholder="Ingrese el nombre de su parroquia" style="width:100%;" value="<?php echo $_SESSION['nom_loc'];?>"/>
                            <input type="hidden" name="id_loc" id="id_loc" value="<?php echo $_SESSION['id_loc'];?>" />
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#F00;">*</td><td style="font-weight:bold;">Email:</td><td><input type="text" name="txtemail" id="txtemail" value="<?php echo $_SESSION['ema_usu'];?>" style="width:100%;" /></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="background-color:#036; color:#FFF; font-weight:bold;">Datos de Usuario</td>
                    </tr>
                    <tr>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#F00;">*</td><td style="font-weight:bold;">Usuario:</td><td><input type="text" name="txtusuario" id="txtusuario" value="<?php echo $_SESSION['nus_usu'];?>" style="width:100%;" /></td>
                    </tr>
                    <tr>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#F00;">*</td><td style="font-weight:bold;">Contraseña:</td><td><input type="text" name="txtpass" id="txtpass" value="<?php echo $_SESSION['con_usu'];?>" style="width:100%;" />
                        <input type="hidden" name="id_usu" id="id_usu" value="<?php echo $_SESSION['id_usu'];?>" />
                        <input type="hidden" name="id_per" id="id_per" value="<?php echo $_SESSION['id_per'];?>" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table width="100%">
    	<tr><td align="center" style="font-family:Arial, Helvetica, sans-serif; font-style:italic; font-weight:bold; font-size:14px;">Los campos marcados (*) serán considerados como requeridos.</td></tr>
    	<tr><td align="center"><input type="button" name="bteperfil" id="bteperfil" class="imageneditarboton" /></td></tr>
        <tr><td align="center">Editar</td></tr>
    </table>
</form>
