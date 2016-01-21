<?php
if(isset($_FILE["file"]))
{
	$file=$_FILE["file"];
	$nombre=$file["name"];
	$tipo=$file["Type"];
	$ruta_provicional=$file["tmp_name"];
	$carpeta="../../imagenes/";
	$src=$carpeta.$nombre;
	echo $src;
}
?>