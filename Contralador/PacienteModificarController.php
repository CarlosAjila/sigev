<?php

require_once('../Modelo/clsPersona.php');
require_once('../Modelo/clsGeoreferenciacion.php');
require_once('../Modelo/clsPaciente.php');



//if (isset($_POST["modificar_paciente"])) {
    
   
// $objpersona = new clsPersona();
//$arre =$objpersona ->c_buscar_cedula("105");
//$objpersona->c_modificar_persona(
//        $arre[0]["id_per"], 
//        $arre[0]["id_loc"], 
//        $arre[0]["ced_per"], 
//        "jose-jose", 
//        $arre[0]["sno_per"], 
//        $arre[0]["apa_per"], 
//        $arre[0]["ama_per"], 
//        $arre[0]["fna_per"], 
//        $arre[0]["te1_per"], 
//        $arre[0]["te2_per"], 
//        $arre[0]["sex_per"], 
//        $arre[0]["est_per"]);
    //echo 'por a qui modificar';
    /* Datos de persona */
    $id_per = $_POST['id_per'];
//    $id_loc = $_POST['id_loc'];
//    $ced_per = $_POST['txtcedula'];
//    $pno_per = $_POST['txtpnombre'];
//    $sno_per = $_POST['txtsnombre'];
//    $apa_per = $_POST['txtapaterno'];
//     $ama_per = $_POST['txtamaterno'];
//    $fna_per = $_POST['txtfn'];
// 
//    
//   
//    $te1_per = $_POST['txtcel'];
//    $te2_per = $_POST['txttel'];
//    $sex_per = $_POST['sex_per'];
//    $estado = "A";

//    /* Datos Georeferenciacion */
//    $id_geo = $_POST['id_geo'];
//
//    /* Datos de paciente */
//    $oex_pac = $_POST['txtexpac']; //lugar en el cual se realizó los exámenes
//
//    $fre_pac = $_POST['time']; //
//    $cas_pac = $_POST['txtcaspac']; //
//    $dir_pac = $_POST['txtdirpac'];
//    $ref_pac = $_POST['txtrefpac']; //
//    $ofi_pac = $_POST['txtofipac']; //
//    $dof_pac = $_POST['txtdofpac'];
//    $emi_pac = $_POST['txtemipac']; //
//    $fat_pac = $_POST['txfatpac'];
//    $fis_pac = $_POST['txfispac'];
//    $est_pac = "A";
//
//    /* Datos de paciente */
//    $oex_pac = $_POST['txtexpac']; //lugar en el cual se realizó los exámenes
//    $time = time();
//    $fre_pac = date("y-m-d (H:i:s)", $time); //
//    $cas_pac = $_POST['txtcaspac']; //
//    $dir_pac = $_POST['txtdirpac'];
//    $ref_pac = $_POST['txtrefpac']; //
//    $ofi_pac = $_POST['txtofipac']; //
//    $dof_pac = $_POST['txtdofpac'];
//    $emi_pac = $_POST['txtemipac']; //
//    $fat_pac = $_POST['txfatpac'];
//    $fis_pac = $_POST['txfispac'];
//    $est_pac = "A";

//    $objpersona = new clsPersona();
//    $objpersona->c_modificar_persona(
//            $id_per, 
//            $id_loc, 
//            $ced_per, 
//            $pno_per, 
//            $sno_per,
//            $apa_per, 
//            $ama_per, 
//            $fna_per, 
//            $te1_per, 
//            $te2_per, 
//            $sex_per, 
//            $estado);
//    $objPaciente = new clsPaciente();
//    $objPaciente->c_modificar_paciente(
//            $id_pec, 
//            $id_geo, 
//            $id_per, 
//            $oex_pac, 
//            $fre_pac, 
//            $cas_pac, 
//            $dir_pac, 
//            $ref_pac, 
//            $ofi_pac, 
//            $dof_pac, 
//            $emi_pac, 
//            $fat_pac, 
//            $fis_pac, $est_pac);

    $mensaje = 'Paciente Modificado con éxito';
    $salidaJson = array(
        'mensaje' => $mensaje,
        'id_persona' => $id_per);
    echo json_encode($salidaJson);
//}

?>