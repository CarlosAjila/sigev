<?php
sleep(3);

define("maxUpload", 500000);
define("maxWidth", 900);
define("maxHeight", 900);
// la carpeta donde vamos a depositar nuestras fotos debe tener permisos de escritura 777
// De lo contrario obtendremos error
define("uploadURL", 'imagenes/');
define("fileName", 'foto_');

$ruta_provisional=$file["tmp_name"];
$size=$file["size"];
$dimensiones=getimagesize($ruta_provisional);
$width=$dimensiones[0];
$height=$dimensiones[1];

$fileType = array('image/jpeg','image/pjpeg','image/png');

// Bandera para procesar las fotos si pasa el tamaño definido
$pasaImgSize = false;
 
//bandera de error al procesar las fotos
$respuestaFile = false;
 
// nombre por default de las fotos a subir
$fileName = '';
 
// error del lado del servidor
$mensajeFile = 'ERROR EN EL SCRIPT';

// Obtenemos los datos del archivo
$tamanio = $_FILES['userfile']['size'];
$tipo = $_FILES['userfile']['type'];
$archivo = $_FILES['userfile']['name'];

// Tamaño de la imagen
$imageSize = getimagesize($_FILES['userfile']['tmp_name']);
 
// Verificamos la extensión del archivo independiente del tipo mime
$extension = explode('.',$_FILES['userfile']['name']);
$num = count($extension)-1;

// Creamos el nombre del archivo dependiendo la opción
$imgFile = fileName.time().'.'.$extension[$num];

// Verificamos el tamaño válido para las fotos
if($width > 500 || $height>500)
	$pasaImgSize = true;

// Verificamos el status de las dimensiones de la imagen a publicar mediante nuestro jQuery para fotos
if($pasaImgSize == true)
{
	// Verificamos Tamaño y extensiones
	if(in_array($tipo, $fileType) && $tamanio>0 && $tamanio<=maxUpload && ($extension[$num]=='jpg' || $extension[$num]=='png'))
	{
		// Intentamos copiar el archivo
		if(is_uploaded_file($_FILES['userfile']['tmp_name']))
		{
                        // Verificamos si se pudo copiar el archivo a nustra carpeta
			if(move_uploaded_file($_FILES['userfile']['tmp_name'], uploadURL.$imgFile))
			{
				$respuestaFile = 'done';
				$fileName = $imgFile;
				$mensajeFile = $imgFile;
			}
			else
				// error del lado del servidor
				$mensajeFile = 'No se pudo subir el archivo';
		}
		else
			// error del lado del servidor
			$mensajeFile = 'No se pudo subir el archivo';
	}
	else
		// Error en el tamaño y tipo de imagen
		$mensajeFile = 'Verifique el tamaño y tipo de imagen';

}
else
	// Error en las dimensiones de la imagen
	$mensajeFile = 'Verifique las dimensiones de la Imagen';

$salidaJson = array("respuesta" => $respuestaFile,
					"mensaje" => $mensajeFile,
					"fileName" => $fileName);
 
echo json_encode($salidaJson);
?>