<?php
sleep(1);
$file=$_FILES["file"];
$nombre=$file["name"];
$tipo=$file["type"];
$ruta_provisional=$file["tmp_name"];
$size=$file["size"];
$dimensiones=getimagesize($ruta_provisional);
$width=$dimensiones[0];
$height=$dimensiones[1];
$carpeta="../imagenes/";
		
if($size > 1024*1024)
{
	$mensaje="Tamaño de imagen demasiado grande";
} 
else if($tipo!='image/jpg' && $tipo!='image/jpeg' && $tipo!='image/png' && $tipo!='image/gif')
{
	$mensaje="Error, el archivo no es compatible";
}
else if($width > 500 || $height>500)
{
	$mensaje="Error anchura maxima";
}
else if($width < 60 || $height < 60)
{
	$mensaje="Error achura minima";
}

else 
{
	$mensaje="Foto cargada exitosamente";
}

if($mensaje == "Foto cargada exitosamente")
{
	$src= $carpeta.$nombre;
	move_uploaded_file($ruta_provisional,$src);
}
else
{
	$src="../imagenes/fotoperfil.jpg";
}
$salidaJson = array("ruta" => $src,"mensaje" => $mensaje);
echo json_encode($salidaJson);
?>