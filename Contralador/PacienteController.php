<?php

require_once('../Modelo/clsPersona.php');
require_once('../Modelo/clsGeoreferenciacion.php');
require_once('../Modelo/clsPaciente.php');
require_once('../Modelo/clsPaciente_enfermedad.php');
require_once('../Modelo/clsSintoma_paciente.php');

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
    $estado = "A";

    /* Datos Georeferenciacion */

    $lat_geo = $_POST['latitud'];
    $lon_geo = $_POST['longitud'];


    /* Datos de paciente */
    $oex_pac = $_POST['txtexpac']; //lugar en el cual se realizó los exámenes
    $time = time();
    $fre_pac = date("y-m-d (H:i:s)", $time); //
    $cas_pac = $_POST['txtcaspac']; //
    $dir_pac = $_POST['txtdirpac'];
    $ref_pac = $_POST['txtrefpac']; //
    $ofi_pac = $_POST['txtofipac']; //
    $dof_pac = $_POST['txtdofpac'];
    $emi_pac = $_POST['txtemipac']; //
    $fat_pac = $_POST['txfatpac'];
    $fis_pac = $_POST['txfispac'];
    $est_pac = "A";

    // Datos de Paciente Enfermedad
    $id_enf = $_POST['id_enf'];

    $objpersona = new clsPersona($id_loc, $ced_per, $pno_per, $sno_per, $apa_per, $ama_per, $fna_per, $te1_per, $te2_per, $sex_per, $estado);
    $id_per = $objpersona->insertar($id_loc, $ced_per, $pno_per, $sno_per, $apa_per, $ama_per, $fna_per, $te1_per, $te2_per, $sex_per);

    $objgeoreferenciacion = new clsGeoreferenciacion($lat_geo, $lon_geo);
    $id_geo = $objgeoreferenciacion->insertar($lat_geo, $lon_geo);

    $objPaciente = new clsPaciente(
            $id_geo, $id_per, $oex_pac, $fre_pac, $cas_pac, $dir_pac, $ref_pac, $ofi_pac, $dof_pac, $emi_pac, $fat_pac, $fis_pac, $est_pac);
    $id_pac = $objPaciente->insertar();

    $objpaciente_enfermedad = new clsPaciente_enfermedad($id_pac, $id_enf, $est_pac);
    $id_pae = $objpaciente_enfermedad->insertar();


    $arregloCHK = $_POST['chk'];
    $numm = count($arregloCHK);
    $obsSintoma_paciente = new clsSintoma_paciente();
    for ($n = 0; $n < $numm; $n++) {
        $obsSintoma_paciente->insertar($id_pae, $arregloCHK[$n]);
    }
    $mensaje = "Paciente registrado con éxito";
    $salidaJson = array("mensaje" => $mensaje);
    echo json_encode($salidaJson);
}
if (isset($_POST['modificar_paciente'])) {
    $objpersona = new clsPersona("", "", "", "", "", "", "", "", "", "", "");
//	$id_per=$_POST['id_per'];
//	$cedula=$_POST['txtcedula'];
//	$pnombre=$_POST['txtpnombre'];
	
    $id_per=$_POST['id_per'];
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
    $estado = "A";

//    echo $cedula . $pnombre . $id_per;
//   $objpersona->modif_persona($cedula,$pnombre,$id_per);
    $objpersona->c_modificar_perfil_persona(
            $id_per, 
            $ced_per, 
            $pno_per, 
            $sno_per, 
            $apa_per, 
            $ama_per, 
            $te1_per, 
            $te2_per, 
            $fna_per, 
            $id_loc);
    $mensaje = "Paciente modificado con éxito";
    $salidaJson = array("mensaje" => $mensaje);
    echo json_encode($salidaJson);
}
?>