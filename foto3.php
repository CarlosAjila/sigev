<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="jquery-1.11.3/jquery-1.11.3.js"></script>
<script src="AjaxUpload.2.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="Estilos/estilos.css" />
<link rel="stylesheet" type="text/css" href="Estilos/fontello.css" />
<link rel="stylesheet" type="text/css" href="Estilos/EstiloRegistrar.css" />
<script type="text/javascript" >
	$(function(){
		var btnUpload=$('#btimagen');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'upload-file.php',
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
				$('#fotoPerfil').attr('src',respuesta.ruta);
				$('#ruta').val(respuesta.ruta); 
				$('#load').attr('class','imagenno');
			}
		});
	});
</script>
</head>

<body>
<div id="mainbody" >
		<h3>&raquo; AJAX File Upload Form Using jQuery</h3>
		<!-- Upload Button, use any id you wish-->
		<img id="load" src="imagenes/load.gif" class="imagenno">
		<span id="status"></span>
        <img id="fotoPerfil" src="imagenes/perfil.jpg" />
        <input type="button" id="btimagen" value="Cargar Imagen" />
        <input type="text" id="ruta" />
		<ul id="files" ></ul>
</div>
</body>
</html>