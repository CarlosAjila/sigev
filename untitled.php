<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

	<?php
		$valores=array("Selecciona un elemento", "opcion 1", "opcion 2", "opcion 3");
 
		if(isset($_POST["prueba"]))
		echo "Seleccionado opción: ".$valores[$_POST["prueba"]];
	?>
 
	<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
		<select name="prueba">
		<?php
        foreach($valores as $key=>$value)
        {
            if($_POST["prueba"]==$key)
                echo "<option value='".$key."' selected>".$value."</option>";
            else
                echo "<option value='".$key."'>".$value."</option>";
        }
        ?>
		<input type="submit" value="Enviar">
	</form>
</body>
</html>