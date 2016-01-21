
<?php

require_once("../Modelo/clsEnfemedad.php");

echo 'fgfgdfgdf';

$objenfermedad = new clsEnfemedad();

$arre = $objenfermedad->c_listar_enfermedad();
//
echo $arre[0]['nom_enf'];
//foreach ($array as $value) {
//    echo '111';
//    echo $value['id_enf'].' '.$value['nom_enf'].' '.$value['pri_enf'];
//}


?>