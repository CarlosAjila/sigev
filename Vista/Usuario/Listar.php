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
		url:'../../Contralador/prueba_listar.php',
		data:'dato='+value,
		success: function(datos){
			$('#lista').html(datos);
		}
	  })
    }).keyup();
});
</script>
<script language="javascript">

function eliminarProducto(id){
	var url = '../../Contralador/Celiminar_usuario.php';
	var buscar=$('#txtbuscar').val();
	var pregunta = confirm('¿Esta seguro de eliminar este Producto?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id+'&dato='+buscar,
		success: function(registro){
			$('#lista').html(registro);
			//return false;
		}
	});
	//return false;
	}
}

function editar(id_per,id_car,fecha){
	var url = '../../Contralador/Ceditar_usuario.php';
	var buscar=$('#txtbuscar').val();
	$.ajax({
	type:'POST',
	url:url,
	data:'id_per='+id_per+'&id_car='+id_car+'&fecha='+fecha+'&dato='+buscar,
	success: function(registro){
		$('#lista').html(registro);
		return false;
		}
	});
}
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
            	<td>Ingrese Nombre o Apellido para iniciar la búsqueda</td>
            </tr>
            <tr>
            	<td>
                <input type="text" name="txtbuscar" id="txtbuscar" placeholder="Ingrese índice de búsqueda.." class="txtbuscar"/>
                </td>
            </tr>
        </table>
        <div id="lista" class="listado"></div>
    </section>
</form>
</body>
</html>