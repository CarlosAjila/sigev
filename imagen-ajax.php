<?php
	if(isset($_FILES["file"]))
	{
		$file=$_FILES["file"];
		$nombre=$file["name"];
		$tipo=$file["type"];
		$ruta_provisional=$file["tmp_name"];
		$size=$file["size"];
		$dimensiones=getimagesize($ruta_provisional);
		$width=$dimensiones[0];
		$height=$dimensiones[1];
		$carpeta="imagenes/";
		
		if($tipo!='image/jpg' && $tipo!='image/jpeg' && $tipo!='image/png' && $tipo!='image/gif')
		{
			echo "Error, el archivo no es compatible";
		}
		else if($size > 1024*1024)
		{
			echo "Erro, tamaño";
		}
		else if($width > 500 || $height>500)
		{
			echo "Error anchura maxima";
		}
		else if($width < 60 || $height < 60)
		{
			echo "Error achura minima";
		}
		else
		{
			$src= $carpeta.$nombre;
			move_uploaded_file($ruta_provisional,$src);
			echo "<img src='$src'>";
			//$salidaJson = array("fileName" => $nombre);
		}
	}
?>
