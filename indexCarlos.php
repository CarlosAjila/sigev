<?php

require 'Contralador/PacienteController.php';
//require_once('Contralador/PacienteController.php');
echo 'jklxcjlxjlkvjlkxcjlkv';
//se instancia al controlador 
$mvc = new PacienteController();
echo '22222222';
$mvc->principal();

echo '33333333333';
if ($_GET['action'] == 'buscar') { //muestra el modulo del buscador
    //$mvc->buscador();
    echo '4444444';
} else if ($_GET['action'] == 'history') { //muestra  el modulo "historia de Bolivia"
    $mvc->historia();
    echo '5555555';
} else
if (isset($_POST['casos']) && isset($_POST['cantidad'])) {//muestra el buscador y los resultados
    $mvc->buscar($_POST['casos'], $_POST['cantidad']);
    echo '66666666';
} else { //Si no existe GET o POST -> muestra la pagina principal
    echo '777777777777';
    $mvc->principal();
}
?>