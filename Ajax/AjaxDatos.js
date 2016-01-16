$(document).ready(function(e) {
function listar_usuarios(){
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(row_persona){
			
			$('#agrega-registros').html(registro);
			
		}
	});
	return false;
}
});