<?php
require_once("../Modelo/clsLocalizacion.php");

$nom_loc="S";
$localizacion = new clslocalizacion($_GET['term']);
$origen=$localizacion->buscar();

echo json_encode($origen);
?>