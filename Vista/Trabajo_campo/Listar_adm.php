<?php
//initialize the session
  session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloListarUsuario.css" />
<link rel="stylesheet" type="text/css" href="../../jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css" />

<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloRegistrar.css" />
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloAdministrador.css" />
<link rel="stylesheet" type="text/css" href="../../Estilos/EstiloPaciente.css" />
<link rel="stylesheet" type="text/css" href="../../Estilos/fontello.css" />

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>



<title>SIGEV - Listado de Trabajo de Campo</title>

<!--Librerias para el uso de Jquery 1.11.3-->
<link rel="stylesheet" type="text/css" href="../../jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css" />
<script src="../../jquery-1.11.3/jquery-1.11.3.js"></script>
<script src="../../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
<script src="../../AjaxUpload.2.0.min.js"></script>

<script language="javascript" type="text/javascript" src="../../Validaciones/Validacion.js"></script>

<script language="javascript">
	$(document).ready(function(){
		 $('#txtbuscar').keyup(function () {
		  var value = $(this).val();
		  $.ajax({
			type:'POST',
			url:'../../Contralador/CListarTrabajoCampo.php',
			data:'dato='+value,
			success: function(datos){
				$('#lista').html(datos);
			}
		  })
		}).keyup();
	});
 	function AbrirDialogo(id){				
		
		var id = id;		             
        $.ajax({
        	type: 'POST',
            url: '../../Contralador/CTrabajoCampoFicha.php',
            	data: 'id=' +id,
            	success: function (datos) {
            	$('#ficha').html(datos);
            	return false;
            }
      });
		$("#dialog").dialog({
			autoOpen:false,
			modal:true,
			width:830,
			height:780
		});
		$('#dialog').dialog('open');
	}		
	
		
	
</script>

<script>
function editar(){				
		var isNotOk;
		var num=window.document.FormTrabajoCampo.num_personas.value;
		if(num=="")
		{
			alert("Debe Ingresar # Personas")
			document.FormTrabajoCampo.num_personas.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var cant_quimico=window.document.FormTrabajoCampo.cant_quimico.value;
		if(cant_quimico=="")
		{
			alert("Debe Ingresar Cantidad de Quimico")
			document.FormTrabajoCampo.cant_quimico.focus();
			return false;
			isNotOk=true;
		}
		
		var isNotOk;
		var criterio_tecnico=window.document.FormTrabajoCampo.criterio_tecnico.value;
		if(criterio_tecnico=="")
		{
			alert("Debe Ingresar el Criterio Técnico")
			document.FormTrabajoCampo.criterio_tecnico.focus();
			return false;
			isNotOk=true;
		}
		if(isNotOk)
		{
			return false;
		}
		else
		{			
			var ruta = "../../Contralador/CTrabajoCampoEditar.php";	
			$.ajax({
				url:ruta,
				type:'POST',
				dataType:'json',
				data: $('#FormTrabajoCampo').serialize(),
				success: function(json){				
					//Parseamos el array JSON
					alert(json.mensaje);				
				   //$('#resultado').html(datos); // Mostrar la respuestas del script PHP.
				   	//alert ("Datos Modificados con Éxito-->");
				   
				   document.getElementById('FormTrabajoCampo').submit(); 
				}
			});						
		}	
}			

	
</script>


</head>

<body>
	
    <header>
	<div> 
    	<h1><img src="../../imagenes/lbanner-05.png" class="logo" /></h1>
        <input type="checkbox" id="menu-bar" />
        <label class="icon-menu" for="menu-bar"></label>
        <nav class="menu">
        	<a href="../Administrador/Inicio.php" style="font-size:18px;" class="icon-inicio">Inicio</a>
        </nav>
    </div>
	</header>
	
    <h1>
    	trabajo de campo para el paciente        
    </h1>		
	
    <form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="FormTrabajosCampos" id="FormTrabajosCampos">
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
        <div id="lista" class="listado">        
        </div>
    
    </form>
    
        <div id="dialog" style="display: none;" title="FICHA DE TRABAJO DE CAMPO">
        <div style="width: 700px; height: 300px;" id="int_dialog">
            <div style="font-size: 14px; width: 470px;">			
                <div id="ficha" align="left">                
                </div>                                      
            </div>
        </div>
    
</div>
</body>
</html>