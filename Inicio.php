<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
<link rel="stylesheet" type="text/css" href="Estilos/estilos.css" />
<link rel="stylesheet" type="text/css" href="Estilos/fontello.css" />
<title>SIGEV</title>
</head>

<script language="javascript">
$(document).ready(function(){
	$('#txtnusuario').val('');
	$('#txtpass').val('');
});
</script>

<body class="imagenfondo">
<div id="diviniciosesion">
	<form method="POST" name="FormInicioSesion" id="FormInicioSesion" action="Contralador/Cvalidar_usuario.php" enctype="multipart/form-data"> 
    <table width="100%">
    	<tr>
        	<td align="center" valign="bottom"></td>
        </tr>
    </table>
	<table class="tablainicio">
      <tr>
        <td colspan="3" align="center" style="background-color:#FFF;"><img src="imagenes/lbanner-05.png" style="width:240px; height:80px;" /></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" align="center" class="txt18">Inicio de sesión</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" align="center">
        	<table class="tablainterna">
            	<tr>
                	<td>
                    <label class="icon-usuario" style="font-size:24px; color:#036;"></label>
                    </td>
                    <td>
                    <input type="text" name="txtusuario" id="txtusuario" class="txt_login" placeholder="Usuario" style="border:none;"/>
                    </td>
                </tr>
        	</table>
        </td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" align="center">
        	<table class="tablainterna">
            	<tr>
                	<td>
                    <label class="icon-clave" style="font-size:24px; color:#036;"></label>
                    </td>
                    <td>
                    <input type="password" name="txtpassword" id="txtpassword" class="txt_login" placeholder="Contraseña" style="border:none;"/>
                    </td>
                </tr>
        	</table>
        </td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" align="center"><input type="submit" id="btiniciar" name="btiniciar" value="Iniciar sesión" class="btiniciarsesion" /></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" align="center" class="txt18">¿No tiene cuenta de inicio de sesión?</td>
      </tr>
      <tr>
        <td colspan="3" align="center"><a href="Vista/Usuario/Registrar.php" id="crearcuenta">Crear Cuenta</a></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
    </table>
    </form>
</div>
</body>
</html>