<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="jquery-1.11.3/jquery-1.11.3.js"></script>
<script src="AjaxUpload.2.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="Estilos/estilos.css" />
<script>
	$(function(){
		$("input[name='file']").on("change",function(){
			var formData = new FormData($("#formulario")[0]);
			var ruta = "imagen-ajax.php";
			$.ajax({
			url:ruta,
			type:'POST',
			data: formData,
			contentType:false,
			processData:false,
			success: function(datos)
			{
				$('#respuesta').html(datos);
			}
			});
		});
	});
</script>
</head>

<body>
<form method="post" id="formulario" enctype="multipart/form-data">
	
    <div class="upload">
    <span>Upload</span>
    <input type="file" name="file" class="foto"/>
	</div>
</form>
<div id="respuesta"><img src="imagenes/perfil.jpg"></div>
</body>
</html>