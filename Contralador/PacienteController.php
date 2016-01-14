<?php

require_once('../Modelo/clsPersona.php');
require_once('../Modelo/clsGeoreferenciacion.php');
require_once('../Modelo/clsPaciente.php');

/*
echo('entro por a qui');

	$objPaciente3 = new clsPaciente(
	'1', 
	'11', 
	'MACHAL', 
	'2016-01-28', 
	'Presuntivo', 
     'Guabo y novena Oeste', 
	 'Cancha del Colegio 9 de Octubre', 
	 'Medico', 
	 'Las brisas',
	  'dfhdgf@gmail.com', 
	  '2016-01-28', 
	  '2016-01-28', 
	  'A');	
	$objPaciente3->insertar();*/
	
if (isset($_POST['save_paciente'])) {
    /* Datos de persona */
    $id_loc = $_POST['id_loc'];
    $ced_per = $_POST['txtcedula'];
    $fna_per = $_POST['txtfn'];
    $pno_per = $_POST['txtpnombre'];
    $sno_per = $_POST['txtsnombre'];
    $apa_per = $_POST['txtapaterno'];
    $ama_per = $_POST['txtamaterno'];
    $te1_per = $_POST['txtcel'];
    $te2_per = $_POST['txttel'];
    $sex_per = $_POST['sex_per'];
    $estado="A";
    /* Datos Georeferenciacion */
    $lat_geo = "88858858585";
    $lon_geo = "95959595955";
    $est_geo = "A";
    /* Datos de paciente */
    $oex_pac = $_POST['txtexpac']; //lugar en el cual se realizó los exámenes
    $fre_pac = $_POST['txtfrepac']; //
    $cas_pac = $_POST['txtcaspac']; //
    $dir_pac = $_POST['txtdirpac'];
    $ref_pac = $_POST['txtrefpac']; //
    $ofi_pac = $_POST['txtofipac']; //
    $dof_pac = $_POST['txtdofpac'];
    $emi_pac = $_POST['txtemipac']; //
    $fat_pac = $_POST['txfatpac'];
    $fis_pac = $_POST['txfispac'];
    $est_pac = "A";

    $objPersona = new clsPersona($id_loc, $ced_per, $pno_per, $sno_per, $apa_per, $ama_per, $fna_per, $te1_per, $te2_per, $sex_per, $estado);
    $id_per = $objPersona->insertar();

    $objGeoreferenciacion = new clsGeoreferenciacion($lat_geo, $lon_geo, $est_geo);
    $id_geo = $objGeoreferenciacion->insertar();
   
    $objPaciente = new clsPaciente(
            $id_geo, 
            $id_per, 
            $oex_pac, 
            $fre_pac, 
            $cas_pac, 
            $dir_pac, 
            $ref_pac, 
            $ofi_pac, 
            $dof_pac, 
            $emi_pac, 
            $fat_pac, 
            $fis_pac, 
            $est_pac);
    $objPaciente->insertar();

    $mensaje = 'Paciente registrada con éxito';
    $salidaJson = array('mensaje' => $id_per,
                        'id_geo' => $id_geo);
    echo json_encode($salidaJson);
}
?>