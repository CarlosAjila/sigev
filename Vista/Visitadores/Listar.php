<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloListarUsuario.css" />
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloAdministrador.css" />
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloPaciente.css" />
<link rel="stylesheet" type="text/css" href="../../jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css" />
<link rel="stylesheet" href="../../Estilos/fontello.css" />
<script src="../../jquery-1.11.3/jquery-1.11.3.js"></script>
<script src="../../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
<script src="../../AjaxUpload.2.0.min.js"></script>

<title>SIGEV - Listar Usuarios</title>
<script language="javascript">
$(document).ready(function(){
	 $('#txtbuscar').keyup(function () {
      var value = $(this).val();
      $.ajax({
		type:'POST',
		url:'../../Contralador/Clista_visitador.php',
		data:'dato='+value,
		success: function(datos){
			$('#lista').html(datos);
		}
	  })
    }).keyup();
});
</script>
<script language="javascript">

function asignar(id_pac,id_usu,tip_aca){
	var url = '../../Contralador/Casignar_caso.php';
	var buscar=$('#txtbuscar').val();
	$.ajax({
	type:'POST',
	url:url,
	data:'id_pac='+id_pac+'&id_usu='+id_usu+'&tip_aca='+tip_aca+'&dato='+buscar,
	success: function(registro){
		$('#lista').html(registro);
		return false;
		}
	});
}

function ver_casos_asignados(id_usu)
{
	$.ajax({
		type: 'POST',
		url: '../../Contralador/Ccasos_visitador.php',
		data: 'id_usu=' + id_usu,
		success: function (casos) {
			$('#dialogo_ver_casos_asignados').html(casos);
			return false;
		}
	});

	$('#dialogo_ver_casos_asignados').dialog('open');
}
</script>

<script language="javascript">
$(document).ready(function(e) {
    $('#dialogo_ver_casos_asignados').dialog({
		autoOpen:false,
		modal:true,
		width:750,
		height:450
	});
});
</script>
</head>

<body>
<form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="form91" id="form91">
	<header>
	<div id="conte" class="contenedor">
    

    	<h1><img src="../../imagenes/lbanner-05.png" class="logo" /></h1>
        <input type="checkbox" id="menu-bar" />
        <label class="icon-menu" for="menu-bar"></label>
        <nav class="menu">
        	<a href="../Administrador/Inicio.php" style="font-size:18px;" class="icon-inicio">Inicio</a>
        </nav>
    </div>
	</header>
    <section class="cuerpo">
    	<table width="100%" class="tabla">
        	<tr>
            	<td>Ingrese Nombre o Apellido del visitador para iniciar la búsqueda</td>
            </tr>
            <tr>
            	<td>
                <input type="text" name="txtbuscar" id="txtbuscar" placeholder="Ingrese índice de búsqueda.." class="txtbuscar"/>
                </td>
            </tr>
        </table>
    <div id="lista" class="listado"></div>
    </section>
    <div id="dialogo_ver_casos_asignados" title="Casos asignados al visitador">
    	
    </div>
</form>
</body>
</html>