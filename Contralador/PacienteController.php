<?php

require_once('../Modelo/clsPersona.php');
require_once('../Modelo/clsGeoreferenciacion.php');
require_once('../Modelo/clsPaciente.php');
//require '../Modelo/clsPaciente.php';
//echo 'dfdfdkñlfksñdkfñksñdkf';
//
//$mvc = new PacienteController();
//$mvc->buscar("Todos", 1);
//
//class PacienteController {
//    
//    /* METODO QUE RECIBE LA ORDEN DE BUSQUEDA, PREPARA LOS DATOS Y SE COMUNICA
//      CON EL MODELO  PARA REALIZAR LA CONSULTA
//      INPUT
//      $carrera | nombre de la carrera a buscar
//      $limit | cantidad de registros a mostrar
//      OUTPUT
//      HTML 	| el resultado obtenido del modelo es procesado y convertido en codigo html para que el VIEW pueda mostrarlo
//     */
//
//    function buscar($casos, $cantidad) {
//        $clsPaciente = new clsPaciente();
//        //carga la plantilla 
//        $pagina = $this->load_template('- Resultados de la busqueda -');
//        //carga html del buscador
//        $buscador = $this->load_page('../Vista/Paciente/v.buscador_paciente.php');
//        //obtiene  los registros de la base de datos
//        ob_start();
//        //realiza consulta al modelo
//        $tsArray = $clsPaciente->listarPaciente($casos, $cantidad);
//        if ($tsArray != '') {//si existen registros carga el modulo  en memoria y rellena con los datos 
//            $titulo = 'Resultado de busqueda por "' . $casos . '" ';
//            //carga la tabla de la seccion de VIEW
//            include '../Vista/Paciente/v.listar_paciente.php';
//            $table = ob_get_clean();
//            //realiza el parseado 
//            $pagina = $this->replace_content('/\#CONTENIDO\#/ms', $buscador . $table, $pagina);
//        } else {//si no existen datos -> muestra mensaje de error
//            $pagina = $this->replace_content('/\#CONTENIDO\#/ms', $buscador . '<h1>No existen resultados</h1>', $pagina);
//        }
//        $this->view_page($pagina);
//    }
//
//    /* METODO QUE MUESTRA LA PAGINA PRINCIPAL CUANDO NO EXISTEN NUEVAS ORDENES
//      OUTPUT
//      HTML | codigo html de la pagina
//     */
//
//    function principal() {
//        $pagina = $this->load_template('Pagina Principal MVC');
//        $html = $this->load_page('../Vista/Paciente/m.principal.php');
//        $pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
//        $this->view_page($pagina);
//    }
//
//    /* METODO QUE MUESTRA LA PAGINA HISTORIA DE BOLIVIA, ES UNA PAGINA ESTATICA
//      OUTPUT
//      HTML | codigo html de la pagina
//     */
//
//    function historia() {
//        $pagina = $this->load_template('History of Bolivia');
//        $html = $this->load_page('../Vista/Paciente/m.historia.php');
//        $pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
//        $this->view_page($pagina);
//    }
//
//    /* METODO QUE CARGA LAS PARTES PRINCIPALES DE LA PAGINA WEB
//      INPUT
//      $title | titulo en string del header
//      OUTPIT
//      $pagina | string que contiene toda el cocigo HTML de la plantilla
//     */
//
//    function load_template($title = 'Sin Titulo') {
//        echo '0000001';
//        $pagina = $this->load_page('../Vista/page.php');
//        echo '0000002';
//        $header = $this->load_page('../Vista/sections/s.header.php');
//        echo '0000003';
//        $pagina = $this->replace_content('/\#HEADER\#/ms', $header, $pagina);
//        $pagina = $this->replace_content('/\#TITLE\#/ms', $title, $pagina);
//        $menu_left = $this->load_page('../Vista/sections/s.menuizquierda.php');
//        $pagina = $this->replace_content('/\#MENULEFT\#/ms', $menu_left, $pagina);
//        return $pagina;
//    }
//
//    /* METODO QUE MUESTRA EN PANTALLA EL FORMULARIO DE BUSQUEDA
//      HTML | codigo html de la pagina  con el buscador incluido
//     */
//
//    function buscador() {
//        $pagina = $this->load_template('Busqueda de registros');
//        $buscador = $this->load_page('../Vista/Paciente/v.buscador_paciente.php');
//        $pagina = $this->replace_content('/\#CONTENIDO\#/ms', $buscador, $pagina);
//        $this->view_page($pagina);
//    }
//
//    /* METODO QUE CARGA UNA PAGINA DE LA SECCION VIEW Y LA MANTIENE EN MEMORIA
//      INPUT
//      $page | direccion de la pagina
//      OUTPUT
//      STRING | devuelve un string con el codigo html cargado
//     */
//
//    private function load_page($page) {
//        return file_get_contents($page);
//    }
//
//    /* METODO QUE ESCRIBE EL CODIGO PARA QUE SEA VISTO POR EL USUARIO
//      INPUT
//      $html | codigo html
//      OUTPUT
//      HTML | codigo html
//     */
//
//    private function view_page($html) {
//        echo $html;
//    }
//
//    /* PARSEA LA PAGINA CON LOS NUEVOS DATOS ANTES DE MOSTRARLA AL USUARIO
//      INPUT
//      $out | es el codigo html con el que sera reemplazada la etiqueta CONTENIDO
//      $pagina | es el codigo html de la pagina que contiene la etiqueta CONTENIDO
//      OUTPUT
//      HTML 	| cuando realiza el reemplazo devuelve el codigo completo de la pagina
//     */
//
//    private function replace_content($in = '/\#CONTENIDO\#/ms', $out, $pagina) {
//        return preg_replace($in, $out, $pagina);
//    }
//
//}



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
    $lat_geo = "88858858585";
    $lon_geo = "95959595955";
    $est_geo = "A";
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

    $objpersona = new clsPersona($id_loc, $ced_per, $pno_per, $sno_per, $apa_per, $ama_per, $fna_per, $te1_per, $te2_per, $sex_per, $estado);
    $id_per = $objpersona->insertar($id_loc, $ced_per, $pno_per, $sno_per, $apa_per, $ama_per, $fna_per, $te1_per, $te2_per, $sex_per);

    $objGeoreferenciacion = new clsGeoreferenciacion($lat_geo, $lon_geo, $est_geo);
    $id_geo = $objGeoreferenciacion->insertar();

    $objPaciente = new clsPaciente(
            $id_geo, $id_per, $oex_pac, $fre_pac, $cas_pac, $dir_pac, $ref_pac, $ofi_pac, $dof_pac, $emi_pac, $fat_pac, $fis_pac, $est_pac);
    $objPaciente->insertar();

    $mensaje = 'Paciente registrada con éxito';
    $salidaJson = array('mensaje' => $mensaje,
        'id_per' => $id_per,
        'id_geo' => $id_geo);
    echo json_encode($salidaJson);
}

?>