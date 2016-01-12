<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="jquery-1.11.3/jquery-1.11.3.js"></script>
<script src="AjaxUpload.2.0.min.js"></script>
<title>Documento sin título</title>

</head>
<script>
	$(function(){
		//boton para subir la fot
		var btn_foto=$('#addImage'),interval;
			new AjaxUpload('#addImage',{
				action:'uploadFile.php',
				onSubmit:function(file,ext){
					if(!(ext&& /^(jpg|png)$/.test(ext))){
						//extensiones permitidas
						alert('Solo imagenes jpg o png');
						//cancela el upload
						return false;
					}else{
						$('#loaderAjax').show();
						btn_foto.text('Espere por favor');
						this.disable();
					}
				},
				onComplete: function(file, response){
					btn_foto.text('Cambiar imagen');
					respuesta = $.parseJSON(response);
					if(respuesta.respuesta=='done')
					{
						$('#fotografia').removeAttr('scr');
						$('#fotografia').attr('src','imagenes/'+respuesta.fileName);
					}
					else
					{
						alert(respuesta.mensaje);
					}
					$('#loaderAjax').hide();
					this.enable();
				}
	});
});
	
</script>
<body>
	<div>
    	<header>
        	<h2>Subir foto</h2>
        </header>
        
        <section>
        	<div>
            	<img id="fotografia" src="imagenes/perfil.jpg" />
            </div>
            <input type="button" id="addImage" value="Cambiar imagen" />
        	<div id="loaderAjax">
            	<span>publicando</span>
            </div>
        </section>
    </div>
</body>
</html>