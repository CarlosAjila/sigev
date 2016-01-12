//Evento que se disparará cuando se vaya a cargar una foto de perfil
$(function(){
	var btnUpload=$('#btimagen');
	var status=$('#status');
	new AjaxUpload(btnUpload, {
		action: '../Controlador/CargarFoto.php',
		name: 'uploadfile',
		dataType:'json',
		onSubmit: function(file){
			$('#load').attr('class','imagensi');
			status.text('Cargando...');
		},
		onComplete: function(file, response){
			alert('hola');
			//Parseamos el array JSON
			var respuesta = $.parseJSON(response);
			alert(respuesta.mensaje);
			status.text('');
			$('#fotoPerfil').removeAttr('src');
			$('#fotoPerfil').attr('src',respuesta.ruta);
			$('#load').attr('class','imagenno');
		}
	});
});